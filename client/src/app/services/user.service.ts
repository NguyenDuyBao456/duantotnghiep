import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { catchError, of, tap } from 'rxjs';

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
    localStorage.removeItem('token');
  }

  decoded(token: string) {
    return this.http.get(`http://localhost:8000/api/decode_token`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
  }

  getUser() {
    return this.http.get('http://localhost:8000/api/user');
  }
}
