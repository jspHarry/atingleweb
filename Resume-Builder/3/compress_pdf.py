import os
import sys

dir_path = "/absolute/path/to/directory/"
num_of_pages = 2
out_file = dir_path+"atingle_resume.pdf"


cmd = "gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/screen -dNOPAUSE -dQUIET -dBATCH -sOutputFile="+out_file
for i in range(1,num_of_pages+1):
	filename = dir_path+str(i)+".pdf"
	cmd = cmd+" "+filename

os.system(cmd)