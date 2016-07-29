from threading import Thread;
import SlaveDaemon;
import socket;

class Sender(Thread):
    def __init__(self, daemon, knx_to_read, connected_knx):
        """
        Threaded class retrieving a domoleaf packet and sends it to treatment function
        """
        Thread.__init__(self);
        self.daemon = daemon;
        self.knx_to_read = knx_to_read;
        self.connected_knx = connected_knx;

    def run(self):
        """
        Thread run function overload
        """
        for knx in self.knx_to_read:
            data = knx.recv(TELEGRAM_LENGTH);
            if data:
                self.send_knx_data_to_masters(data);
            if knx in self.connected_knx:
                knx.close();
                self.connected_knx.remove(knx);

    def send_knx_data_to_masters(self, data):
        """
        Converts 'data' from bytes to a clear KNX datagran, and sends it to available slaves.
        """
        ctrl = int(self.daemon.data[0]);
        src_addr = int.from_bytes(self.daemon.data[1:3], byteorder='big');
        dst_addr = int.from_bytes(self.daemon.data[3:5], byteorder='big');
        data_len = int.from_bytes(self.daemon.data[5:6], byteorder='big');
        telegram_data = self.daemon.data[6:7 + data_len];
        typ = -1;
        value = 0;
        if telegram_data[1] & 0xC0 == 0x00:             # read
            typ = 0;
        elif telegram_data[1] & 0xC0 == 0x40:           # resp
            typ = 1;
            if data_len == 2:
                value = int(telegram_data[1] & 0x0f);
            elif data_len > 2:
                value = int.from_bytes(telegram_data[2:data_len], byteorder='big');
        elif telegram_data[1] & 0xC0 == 0x80:           # write
            typ = 2;
            if data_len == 2:
                value = int(telegram_data[1] & 0x0f);
            elif data_len > 2:
                typ = 3;
                value = int.from_bytes(telegram_data[2:data_len], byteorder='big');
        json_str = json.JSONEncoder().encode(
            {
                "packet_type": "monitor_knx",
                "type": typ,
                "src_addr": individual2string(src_addr),
                "dst_addr": group2string(dst_addr),
                "date": str(time.time()).split('.')[0],
                "value": value,
                "sender_name": socket.gethostname()
            }
        );
        print('===== SENDING KNX DATA =====')
        print(json_str)
        print('============================')
        print()
        self.daemon.send_data_to_all_masters(json_str);
