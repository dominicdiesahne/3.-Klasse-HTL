1.  **Statische IPs vergeben:**

- PC2 (Internet) 192.168.3.1; 255.255.255.0; 192.168.3.250; DNS 192.168.2.1

- Webserver/DNS 192.168.2.1; 255.255.255.0; 192.168.2.250

- DHCP-Server 192.168.2.2; 255.255.255.0; 192.168.2.250

- PC3 (Büro) bekommt die IP per DHCP

2.  **Dienste aktivieren**

> Webserver: HTTP (Port 80) und HTTPS (Port 443) auf On
>
> DNS (Port 53): A-Record (server.local 192.168.2.1)
>
> DHCP-Server: Service DHCP On, Pool buero: Default Gateway 192.168.1.250; DNS 192.168.2.1; Start IP 192.168.1.1; 255.255.255.0

3.  **Router-Interfaces konfigurieren**

> Router\> enable
>
> Router# configure terminal
>
> *(Internet 192.168.3.0/24)*
>
> Router(config)# interface FastEthernet0/0
>
> Router(config-if)# ip address 192.168.3.250 255.255.255.0
>
> Router(config-if)# no shutdown
>
> Router(config-if)# exit
>
> *(Büro 192.168.1.0/24, mit DHCP-Helper)*
>
> Router(config)# interface FastEthernet0/1
>
> Router(config-if)# ip address 192.168.1.250 255.255.255.0
>
> Router(config-if)# ip helper-address 192.168.2.2
>
> Router(config-if)# no shutdown
>
> Router(config-if)# exit
>
> *(DMZ 192.168.2.0/24)*
>
> Router(config)# interface FastEthernet1/0
>
> Router(config-if)# ip address 192.168.2.250 255.255.255.0
>
> Router(config-if)# no shutdown
>
> Router(config-if)# exit

4.  **Extended ACL 101 erstellen (Büro)**

> Router(config)# access-list 101 permit udp any host 255.255.255.255 eq 67
>
> Router(config)# access-list 101 permit udp 192.168.1.0 0.0.0.255 host 192.168.2.2 eq 67
>
> Router(config)# access-list 101 permit icmp 192.168.1.0 0.0.0.255 192.168.2.0 0.0.0.255 echo
>
> Router(config)# access-list 101 permit udp 192.168.1.0 0.0.0.255 host 192.168.2.1 eq 53
>
> Router(config)# access-list 101 permit tcp 192.168.1.0 0.0.0.255 host 192.168.2.1 eq 53
>
> Router(config)# access-list 101 permit tcp 192.168.1.0 0.0.0.255 host 192.168.2.1 eq 80
>
> Router(config)# access-list 101 permit tcp 192.168.1.0 0.0.0.255 host 192.168.2.1 eq 443

5.  **Extended ACL 102 erstellen (Internet)**

> Router(config)# access-list 102 permit udp 192.168.3.0 0.0.0.255 host 192.168.2.1 eq 53
>
> Router(config)# access-list 102 permit tcp 192.168.3.0 0.0.0.255 host 192.168.2.1 eq 53
>
> Router(config)# access-list 102 permit tcp 192.168.3.0 0.0.0.255 host 192.168.2.1 eq 80
>
> Router(config)# access-list 102 permit tcp 192.168.3.0 0.0.0.255 host 192.168.2.1 eq 443

6.  **ACLs den Interfaces zuweisen**

> Router(config)# interface FastEthernet0/1
>
> Router(config-if)# ip access-group 101 in
>
> Router(config-if)# exit
>
> Router(config)# interface FastEthernet0/0
>
> Router(config-if)# ip access-group 102 in
>
> Router(config-if)# end
>
> Router# write memory

7.  **Konfiguration prüfen**

> Router# show access-lists
>
> Router# show ip interface FastEthernet0/1

8.  **Ping / Zugriff testen**

> PC3 bekommt IP per DHCP (192.168.1.x) funktioniert
>
> PC3 Ping Webserver und DHCP-Server funktioniert
>
> PC3 Webseite server.local funktioniert
>
> PC2 Webseite server.local funktioniert
>
> PC2 Ping Webserver funktioniert nicht
