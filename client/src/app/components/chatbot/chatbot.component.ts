import { Component, OnInit } from '@angular/core';
import { ChatService } from '../../services/chat.service';

@Component({
  selector: 'app-chatbot',
  standalone: true,
  imports: [],
  templateUrl: './chatbot.component.html',
  styleUrl: './chatbot.component.css',
})
export class ChatbotComponent implements OnInit {
  isOpen: boolean = true;

  chat: any[] = [];

  constructor(private chatService: ChatService) {}

  ngOnInit(): void {}

  clickOpen() {
    this.isOpen = !this.isOpen;
  }

  sendMessage(message: any) {
    if (!message.value) {
      return;
    }

    this.chat.push(
      {
        send: 'user',
        content: message.value,
      },
      {
        send: 'bot',
        content: 'Đang soạn tin...',
      }
    );

    const t = message.value;

    message.value = '';

    this.chatService.answer({ message: t }).subscribe((data: any) => {
      this.chat.push({
        send: 'bot',
        content: data.choices[0].message.content,
      });
      this.chat.splice(this.chat.length - 2, 1);
    });
  }
}
