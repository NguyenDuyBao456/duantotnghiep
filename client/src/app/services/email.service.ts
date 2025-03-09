import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class EmailService {
  constructor(private http: HttpClient) {}

  sendMail(data: any) {
    return this.http.post('http://localhost:8000/api/email/register', data);
  }
}
