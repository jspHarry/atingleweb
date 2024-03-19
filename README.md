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
