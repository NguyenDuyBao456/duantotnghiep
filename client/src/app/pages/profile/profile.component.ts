import { Component, OnInit } from '@angular/core';
import { RouterLink, RouterLinkActive, RouterOutlet } from '@angular/router';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-profile',
  standalone: true,
  imports: [RouterOutlet, RouterLink, RouterLinkActive],
  templateUrl: './profile.component.html',
  styleUrl: './profile.component.css',
})
export class ProfileComponent implements OnInit {
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

  logout() {
    this.userService.logout();

    location.href = '/';
  }
}
