import { Component, OnInit } from '@angular/core';
import { UserService } from '../../../services/user.service';

@Component({
  selector: 'app-info',
  standalone: true,
  imports: [],
  templateUrl: './info.component.html',
  styleUrl: './info.component.css',
})
export class InfoComponent implements OnInit {
  token: any = localStorage.getItem('token')
    ? JSON.parse(localStorage.getItem('token') || '')
    : '';
  user: any;

  ngOnInit(): void {
    this.getUser();
  }

  constructor(private userService: UserService) {}

  getUser() {
    this.userService.decoded(this.token).subscribe((data: any) => {
      this.user = data;
    });
  }
}
