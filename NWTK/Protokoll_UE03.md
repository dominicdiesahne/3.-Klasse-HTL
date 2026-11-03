1.  **VLANs und Trunks auf den Switches**

> *(auf allen Switches)*
>
> Switch(config)# vlan 2
>
> Switch(config)# vlan 3
>
> Switch(config)# vlan 4
>
> *(Switch0: Trunks zu Router und Switch1, Server in VLAN 4)*
>
> Switch(config)# interface fa0/1
>
> Switch(config-if)# switchport mode trunk
>
> Switch(config)# interface fa0/4
>
> Switch(config-if)# switchport mode trunk
>
> Switch(config)# interface range fa0/2 - 3
>
> Switch(config-if)# switchport mode access
>
> Switch(config-if)# switchport access vlan 4
>
> *(Switch1: Trunks zu Switch0 und Switch2, PC0 in VLAN 2)*
>
> Switch(config)# interface range fa0/1 - 2
>
> Switch(config-if)# switchport mode trunk
>
> Switch(config)# interface fa0/3
>
> Switch(config-if)# switchport mode access
>
> Switch(config-if)# switchport access vlan 2
>
> *(Switch2: Trunk zu Switch1, PC1 in VLAN 3)*
>
> Switch(config)# interface fa0/1
>
> Switch(config-if)# switchport mode trunk
>
> Switch(config)# interface fa0/2
>
> Switch(config-if)# switchport mode access
>
> Switch(config-if)# switchport access vlan 3

2.  **Statische IPs und Dienste**

- Server0 (DNS, WEB) 192.168.4.1; 255.255.255.0; 192.168.4.250

- Server1 (DHCP) 192.168.4.2; 255.255.255.0; 192.168.4.250

- PC0 (VLAN 2) und PC1 (VLAN 3) bekommen die IP per DHCP

> Server0: HTTP (Port 80) und HTTPS (Port 443) auf On; DNS (Port 53) A-Record (server.local 192.168.4.1)
>
> Server1: DHCP On, Pool vlan2: Gateway 192.168.2.250; DNS 192.168.4.1; Start IP 192.168.2.1; 255.255.255.0
>
> Server1: Pool vlan3: Gateway 192.168.3.250; DNS 192.168.4.1; Start IP 192.168.3.1; 255.255.255.0

3.  **Router-Subinterfaces konfigurieren**

> Router\> enable
>
> Router# configure terminal
>
> Router(config)# interface FastEthernet0/0
>
> Router(config-if)# no shutdown
>
> Router(config-if)# exit
>
> *(VLAN 2, 192.168.2.0/24)*
>
> Router(config)# interface FastEthernet0/0.2
>
> Router(config-subif)# encapsulation dot1Q 2
>
> Router(config-subif)# ip address 192.168.2.250 255.255.255.0
>
> Router(config-subif)# ip helper-address 192.168.4.2
>
> Router(config-subif)# exit
>
> *(VLAN 3, 192.168.3.0/24)*
>
> Router(config)# interface FastEthernet0/0.3
>
> Router(config-subif)# encapsulation dot1Q 3
>
> Router(config-subif)# ip address 192.168.3.250 255.255.255.0
>
> Router(config-subif)# ip helper-address 192.168.4.2
>
> Router(config-subif)# exit
>
> *(VLAN 4, 192.168.4.0/24)*
>
> Router(config)# interface FastEthernet0/0.4
>
> Router(config-subif)# encapsulation dot1Q 4
>
> Router(config-subif)# ip address 192.168.4.250 255.255.255.0
>
> Router(config-subif)# exit

4.  **Extended ACL 102 erstellen (VLAN 2, PC0 darf pingen)**

> Router(config)# access-list 102 permit udp any host 255.255.255.255 eq 67
>
> Router(config)# access-list 102 permit udp 192.168.2.0 0.0.0.255 host 192.168.4.2 eq 67
>
> Router(config)# access-list 102 permit icmp 192.168.2.0 0.0.0.255 192.168.4.0 0.0.0.255 echo
>
> Router(config)# access-list 102 permit icmp 192.168.2.0 0.0.0.255 192.168.4.0 0.0.0.255 echo-reply
>
> Router(config)# access-list 102 permit udp 192.168.2.0 0.0.0.255 host 192.168.4.1 eq 53
>
> Router(config)# access-list 102 permit tcp 192.168.2.0 0.0.0.255 host 192.168.4.1 eq 53
>
> Router(config)# access-list 102 permit tcp 192.168.2.0 0.0.0.255 host 192.168.4.1 eq 80
>
> Router(config)# access-list 102 permit tcp 192.168.2.0 0.0.0.255 host 192.168.4.1 eq 443

5.  **Extended ACL 103 erstellen (VLAN 3, PC1 darf nicht pingen)**

> Router(config)# access-list 103 permit udp any host 255.255.255.255 eq 67
>
> Router(config)# access-list 103 permit udp 192.168.3.0 0.0.0.255 host 192.168.4.2 eq 67
>
> Router(config)# access-list 103 deny icmp 192.168.3.0 0.0.0.255 192.168.4.0 0.0.0.255 echo
>
> Router(config)# access-list 103 permit icmp 192.168.3.0 0.0.0.255 192.168.4.0 0.0.0.255 echo-reply
>
> Router(config)# access-list 103 permit udp 192.168.3.0 0.0.0.255 host 192.168.4.1 eq 53
>
> Router(config)# access-list 103 permit tcp 192.168.3.0 0.0.0.255 host 192.168.4.1 eq 53
>
> Router(config)# access-list 103 permit tcp 192.168.3.0 0.0.0.255 host 192.168.4.1 eq 80
>
> Router(config)# access-list 103 permit tcp 192.168.3.0 0.0.0.255 host 192.168.4.1 eq 443

6.  **ACLs den Subinterfaces zuweisen**

> Router(config)# interface FastEthernet0/0.2
>
> Router(config-subif)# ip access-group 102 in
>
> Router(config-subif)# exit
>
> Router(config)# interface FastEthernet0/0.3
>
> Router(config-subif)# ip access-group 103 in
>
> Router(config-subif)# end
>
> Router# write memory

7.  **Konfiguration prüfen**

> Router# show access-lists
>
> Router# show ip interface FastEthernet0/0.3

8.  **Ping / Zugriff testen**

> PC0 und PC1 bekommen IP per DHCP funktioniert
>
> PC0 Ping Server0 und Server1 funktioniert
>
> PC1 Ping Server0 und Server1 funktioniert nicht
>
> Server0 Ping PC0 und PC1 funktioniert
>
> PC0 und PC1 Webseite server.local funktioniert
