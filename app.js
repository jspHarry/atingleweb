class Chatbox {
    constructor() {
        this.args = {
            openButton: document.querySelector('.chatbox__button'),
            chatBox: document.querySelector('.chatbox__support'),
            sendButton: document.querySelector('.send__button'),
            closeButton: document.querySelector('.close__button')
        }

        this.state = false;
        this.messages = [];
    }

    display() {
        const {openButton, chatBox, sendButton,closeButton} = this.args;
        openButton.addEventListener('click', () => this.openChatbox(chatBox));
        closeButton.addEventListener('click', () => this.closeChatbox(chatBox));
        // openButton.addEventListener('click', () => this.toggleState(chatBox));

        sendButton.addEventListener('click', () => this.onSendButton(chatBox))

        const node = chatBox.querySelector('input');
        node.addEventListener("keyup", ({key}) => {
            if (key === "Enter") {
                this.onSendButton(chatBox)
            }
        })
    }

    openChatbox(chatbox) {
        this.state = true;
        chatbox.classList.add('chatbox--active');
    }
    
    closeChatbox(chatbox) {
        this.state = false;
        chatbox.classList.remove('chatbox--active');
    }    

    // toggleState(chatbox) {
    //     this.state = !this.state;

    //     if(this.state) {
    //         chatbox.classList.add('chatbox--active')
    //     } else {
    //         chatbox.classList.remove('chatbox--active')
    //     }
    // }

    onSendButton(chatbox) {
        var textField = chatbox.querySelector('input');
        let text1 = textField.value
        if (text1 === "") {
            return;
        }

        let msg1 = { name: "User", message: text1 }
        this.messages.push(msg1);

        fetch( 'http://127.0.0.1:5000/predict', {
            method: 'POST',
            body: JSON.stringify({ message: text1 }),
            mode: 'cors',
            headers: {
              'Content-Type': 'application/json'
            },
          })
          .then(r => r.json())
          .then(r => {
            let msg2 = { name: "Harry", message: r.answer };
            this.messages.push(msg2);
            this.updateChatText(chatbox)
            textField.value = ''

        }).catch((error) => {
            console.error('Error:', error);
            this.updateChatText(chatbox)
            textField.value = ''
          });
    }

    updateChatText(chatbox) {
        var html = '';
        this.messages.slice().reverse().forEach(function(item, index) {
            if (item.name === "Harry")
            {
                html += '<div class="messages__item messages__item--visitor">' + item.message + '</div>'
            }
            else
            {
                html += '<div class="messages__item messages__item--operator">' + item.message + '</div>'
            }
          });

        const chatmessage = chatbox.querySelector('.chatbox__messages');
        chatmessage.innerHTML = html;
    }
}
document.addEventListener('DOMContentLoaded', function() {
    var dialogBox = document.getElementById('dialogBox');
    var visible = false;
    var texts = ['Hey!,I am Harry', 'Happy to Assist!']; 
    var currentIndex = 0; 

    function toggleDialog() {
        if (visible) {
            dialogBox.style.display = 'none';
            visible = false;
        } else {
            dialogBox.textContent = texts[currentIndex];
            currentIndex = (currentIndex + 1) % texts.length; 
            dialogBox.style.display = 'block';
            visible = true;
        }
    }

    setInterval(function() {
        toggleDialog();
        setTimeout(function() {
            toggleDialog();
        }, 2000); 
    }, 3000); 
});





const chatbox = new Chatbox();
chatbox.display();