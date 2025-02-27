import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class UserService {
  constructor(private http: HttpClient) {}

  login(data: any) {
    return this.http.post('http://localhost:8000/api/login', data);
  }

  register(data: any) {
    return this.http.post('http://localhost:8000/api/register', data);
  }

  logout() {
    localStorage.removeItem('user');
  }
}
