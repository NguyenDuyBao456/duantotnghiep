import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-chatbot',
  standalone: true,
  imports: [],
  templateUrl: './chatbot.component.html',
  styleUrl: './chatbot.component.css',
})
export class ChatbotComponent implements OnInit {
  isOpen: boolean = true;

  constructor() {}

  ngOnInit(): void {}

  clickOpen() {
    this.isOpen = !this.isOpen;
  }
}
