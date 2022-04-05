# Installation Instructions

Automated installation.

1. Install virtual box on your machine.
https://www.virtualbox.org/wiki/Downloads

2. Install vagrant on your machine.
https://www.vagrantup.com/downloads

3. Git clone the repository
git clone https://github.com/nsingh0410/twoNumberCalc.git

4. cd into the folder with the "VagrantFile" and run command vagrant up.
This will setup PHP, apache, composer all for you in a ubuntu environment.
The Ip address is 192.168.33.49.

# Usage 

In the authorisation tab in Postman.
Select the type as "Basic Auth".
Username = math
Password = 123

![image](https://user-images.githubusercontent.com/30139083/161738962-6e033bd2-3329-446e-8dda-a6ec7432fe02.png)

To hit the endpoint you have to use local web server followed by api
METHOD TYPE: GET
192.168.33.49/api/twoNumberCalc

To add the input parameters and operations, add the following to the end of the url as a get parameter.
?input1=2&input2=3&operation="+"

full url should look like this.
192.168.33.49/api/twoNumberCalc?input1=2&input2=3&operation="+"

![image](https://user-images.githubusercontent.com/30139083/161739085-5ba6ba0e-50c3-4eae-bb5a-aa7ee3eed480.png)


That should be it enjoy :)
