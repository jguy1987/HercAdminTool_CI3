#!/usr/bin/env python

# This script ships with HAT, or HercAdminTool.
# Please see our project here: https://github.com/jguy1987/HercAdminTool
# Author: Jguy - John Mish
# The MIT license covers this file. Please see applicable license file here: https://github.com/jguy1987/HercAdminTool/blob/master/license.txt
# You are free to include this file wholesale or parts of it in your project, just as long as you leave the above text alone.

# Purpose of file:
# This file is intended to be ran on a remote server.
# It will gather metrics about the running server using the psutils python module and output them via an XML file with lxml.
# Example output:
#<metrics>
#	<basic>
#		<name>machinename</name>
#		<os>Linux-3.10.0-327.el7.x86_64-x86_64-with-centos-7.2.1511-Core</os>
#		<boottime>1365519115.0</boottime>
#	</basic>
#	<cpu>
#		<loadavg>0.5, 0.9, 1.3</loadavg>
#		<proccount>121</proccount>
#	</cpu>
#	<mem>
#		<virtual>
#			<total>10367352832</total>
#			<used>8186245120</used>
#			<avail>2181107712</avail>
#			<pct>37.6</pct>
#		</virtual>
#		<swap>
#			<total>2097147904</total>
#			<used>296128512</used>
#			<avail>1801019392</avail>
#			<pct>14.1</pct>
#		</swap>
#	</mem>
#	<disk>
#		<total>21378641920</total>
#		<used>4809781248</used>
#		<free>15482871808</free>
#	</disk>
#</metrics>

# Import things
import psutil, os, time, sys, platform, socket
from lxml import etree

# get all of the metrics of the running OS. CPU load, MEM usage, disk space.

# load averages...
cpuload = os.getloadavg()

cpuavg = str(cpuload[0])+", "+str(cpuload[1])+", "+str(cpuload[2])
# memory needs a little more work
virt_mem = psutil.virtual_memory()
swap_mem = psutil.swap_memory()

# generate XML using lxml
# <metrics>
root = etree.Element('metrics')
doc = etree.ElementTree(root)
#	<basic>
child1 = etree.SubElement(root, 'basic')
#		<name>
etree.SubElement(child1, "name").text = socket.gethostname()
#		<os>
etree.SubElement(child1, "os").text = platform.platform()
#		<boottime>
etree.SubElement(child1, "boottime").text = str(psutil.boot_time())


#	<cpu>
child2 = etree.SubElement(root, "cpu")
#		<percent>
etree.SubElement(child2, "loadavg").text = str(cpuavg)
#		<proccount>
etree.SubElement(child2, "proccount").text = str(len(psutil.pids()))

#	<mem>
child3 = etree.SubElement(root, "mem")
#		<virtual>
child3_1 = etree.SubElement(child3, "virtual")
#			<total>
etree.SubElement(child3_1, "total").text = str(virt_mem.total)
#			<used>
etree.SubElement(child3_1, "used").text = str(virt_mem.used)
#			<avail>
etree.SubElement(child3_1, "avail").text = str(virt_mem.available)
#			<pct>
etree.SubElement(child3_1, "pct").text = str(virt_mem.percent)
#		<swap>
child3_2 = etree.SubElement(child3, "swap")
#			<total>
etree.SubElement(child3_2, "total").text = str(swap_mem.total)
#			<used>
etree.SubElement(child3_2, "used").text = str(swap_mem.used)
#			<avail>
etree.SubElement(child3_2, "avail").text = str(swap_mem.free)
#			<pct>
etree.SubElement(child3_2, "pct").text = str(swap_mem.percent)

#	<disk>
child4 = etree.SubElement(root, "disk")
disk = os.statvfs(__file__)
free = disk.f_bavail * disk.f_frsize
total = disk.f_blocks * disk.f_frsize
used = (disk.f_blocks - disk.f_bfree) * disk.f_frsize
#		<total>
etree.SubElement(child4, "total").text = str(total)
#		<used>
etree.SubElement(child4, "used").text = str(used)
#		<free>
etree.SubElement(child4, "free").text = str(free)

outFile = open('serverstat.xml', 'w')
doc.write(outFile)
