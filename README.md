# How to use chatbot on your local machine.

## Intial Setup
Clone the repo and create the virtual environment
```
$ git clone https://github.com/jspHarry/atingle.git
$ cd "atingle\Atingle chatbot"
$ python3 -m venv .venv
$ .venv/bin/activate
```
On some devices the command will be
```
$ .venv/Scripts/activate
```
Install dependencies
```
$ (venv) pip install Flask torch torchvision nltk
```
Install nltk package
```
$ (venv) python
>>> import nltk
>>> nltk.download('punkt')
>>>quit()
```
Now to make chatbot work on the frontend run
```
$ (venv) python app.py
```
You are all set to go, you can launch the website in frontend.


# How to setup local server in your local machine.

# Initial steps

1) Install the XAMPP from the following link https://www.apachefriends.org/download.html in 'c' drive only.
2)  After installing XAMPP open XAMPP folder and then go to "htdocs" and here create a folder of any name you want.
3)  Open the folder which you have created & start working on your project(Sign Up page) and connect it to the phpmyadmin.
4)  For configuring email function open php folder in XAMPP and now open php.ini and configure your email.
5)  Now open sendmail folder and then sendmail.ini and write your auth_email and auth_pass and all required details.
6)  Open XAMPP, and turn ON the apache and mysql server.
7)  And, here you go with your local server.
