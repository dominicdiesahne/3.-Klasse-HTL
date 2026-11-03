## 1. Switch1 (VLANs + Trunk)
 
```
enable
configure terminal
hostname Switch1
vlan 2
 name Netz2
vlan 4
 name Netz4
exit
interface fa0/1
 switchport mode trunk
interface fa0/2
 switchport mode access
 switchport access vlan 2
interface fa0/3
 switchport mode access
 switchport access vlan 4
end
write memory
```
 
Switch0 braucht keine Konfiguration, weil alles im Default-VLAN 1 bleibt.
 
## 2. Router0
 
```
enable
configure terminal
hostname R0
interface fa0/0
 ip address 192.168.1.250 255.255.255.0
 no shutdown
interface fa0/1
 ip address 192.168.3.1 255.255.255.0
 no shutdown
exit
! DHCP für Netz 1.0
ip dhcp excluded-address 192.168.1.250
ip dhcp pool NETZ1
 network 192.168.1.0 255.255.255.0
 default-router 192.168.1.250
 dns-server 192.168.1.250
exit
! Statische Routen zu den Netzen hinter R1
ip route 192.168.2.0 255.255.255.0 192.168.3.2
ip route 192.168.4.0 255.255.255.0 192.168.3.2
end
```
 
## 3. Router1 (Router-on-a-Stick)
 
```
enable
configure terminal
hostname R1
interface fa0/1
 ip address 192.168.3.2 255.255.255.0
 no shutdown
interface fa0/0
 no ip address
 no shutdown
interface fa0/0.2
 encapsulation dot1Q 2
 ip address 192.168.2.250 255.255.255.0
interface fa0/0.4
 encapsulation dot1Q 4
 ip address 192.168.4.250 255.255.255.0
exit
! DHCP für Netz 2.0 und 4.0
ip dhcp excluded-address 192.168.2.250
ip dhcp excluded-address 192.168.4.250
ip dhcp pool NETZ2
 network 192.168.2.0 255.255.255.0
 default-router 192.168.2.250
exit
ip dhcp pool NETZ4
 network 192.168.4.0 255.255.255.0
 default-router 192.168.4.250
exit
! Rückroute zu Netz 1.0
ip route 192.168.1.0 255.255.255.0 192.168.3.1
end
```
 
## 4. Routing-Tabelle ausgeben
 
```
R1# show ip route
```
 
```
C    192.168.2.0/24 is directly connected, FastEthernet0/0.2
C    192.168.3.0/24 is directly connected, FastEthernet0/1
C    192.168.4.0/24 is directly connected, FastEthernet0/0.4
S    192.168.1.0/24 [1/0] via 192.168.3.1
```
 
```
show ip interface brief
show ip dhcp binding
show vlan brief           (auf Switch1)
show interfaces trunk     (auf Switch1)
```
 
## 5. Konfiguration sichern und anzeigen
 
Auf beiden Routern und auf Switch1:
 
```
copy running-config startup-config
show running-config
show startup-config
```
 
## 6. Verbindungstest
 
```
PC0> ping 192.168.1.250    (eigenes Gateway)
PC0> ping 192.168.3.2      (R1)
PC0> ping 192.168.2.x      (IP von PC1)
PC0> ping 192.168.4.x      (IP von PC2)
PC1> ping 192.168.4.x      (Inter-VLAN über R1)
```