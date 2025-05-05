import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { catchError, of, tap } from 'rxjs';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root',
})
export class UserService {
  private apiUrl = environment.apiUrl;

  constructor(private http: HttpClient) {}

  login(data: any) {
    return this.http.post(`${this.apiUrl}/api/login`, data);
  }

  register(data: any) {
    return this.http.post(`${this.apiUrl}/api/register`, data);
  }

  logout() {
    localStorage.removeItem('token');
  }

  decoded(token: string) {
    return this.http.get(`${this.apiUrl}/api/decode_token`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
  }

  getUser() {
    return this.http.get(`${this.apiUrl}/api/user`);
  }

  update(data: any, id: any) {
    return this.http.put(`${this.apiUrl}/api/user/${id}`, data);
  }

  changePassword(data: any) {
    return this.http.post(`${this.apiUrl}/api/user/password`, data);
  }
}
