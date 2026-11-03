1.  **Statische IPs vergeben:**

- PC0 192.168.1.1; 255.255.255.0; 192.168.1.250

- PC1 192.168.1.2; 255.255.255.0; 192.168.1.250

- Server0 192.168.2.1; 255.255.255.0; 192.168.2.250

- Server1 192.168.2.2; 255.255.255.0; 192.168.2.250

2.  **Dienste aktivieren**

Server Services

Server0: HTTP(Port 80) und HTTPS(Port 443) auf On

Server1: DNS(Port 53) A-Record(server0.local 192.168.2.1)

3.  **Router-Interfaces konfigurieren**

Router\> enable

Router# configure terminal

*(192.168.1.0/24)*

Router(config)# interface FastEthernet0/0

Router(config-if)# ip address 192.168.1.250 255.255.255.0

Router(config-if)# no shutdown

Router(config-if)# exit

*(192.168.2.0/24)*

Router(config)# interface FastEthernet0/1

Router(config-if)# ip address 192.168.2.250 255.255.255.0

Router(config-if)# no shutdown

Router(config-if)# exit

4.  **Extended ACL 100 erstellen**

Router(config)# access-list 100 permit icmp host 192.168.1.2 192.168.2.0 0.0.0.255

Router(config)# access-list 100 deny icmp host 192.168.1.1 192.168.2.0 0.0.0.255

Router(config)# access-list 100 permit udp 192.168.1.0 0.0.0.255 192.168.2.0 0.0.0.255 eq 53

Router(config)# access-list 100 permit tcp 192.168.1.0 0.0.0.255 192.168.2.0 0.0.0.255 eq 80

Router(config)# access-list 100 permit tcp 192.168.1.0 0.0.0.255 192.168.2.0

0.0.0.255 eq 443

5.  **ACL dem Interface zuweisen**

Router(config)# interface FastEthernet0/0

Router(config-if)# ip access-group 100 in

Router(config-if)# end

Router# do show access-list

Router# do show ip interface FastEthernet0/0

Router# write memory

6.  **Konfiguration prüfen**

Show access-list

7.  **Ping**

PC1 Server0 funktioniert

PC0 Server0 funktioniert nicht

PC1 Server1 funktioniert
