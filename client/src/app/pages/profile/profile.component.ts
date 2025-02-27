import { Component, OnInit } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-profile',
  standalone: true,
  imports: [RouterOutlet],
  templateUrl: './profile.component.html',
  styleUrl: './profile.component.css',
})
export class ProfileComponent implements OnInit {
  user: any = localStorage.getItem('user')
    ? JSON.parse(localStorage.getItem('user') || '')
    : '';

  ngOnInit(): void {
    if (!this.user) {
      location.href = '/';
    }
  }

  constructor(private userService: UserService) {}

  logout() {
    this.userService.logout();

    location.href = '/';
  }
}
