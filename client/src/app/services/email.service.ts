import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root',
})
export class EmailService {
  private apiurl = environment.apiUrl;

  constructor(private http: HttpClient) {}

  sendMail(data: any) {
    return this.http.post(this.apiurl + '/api/email/register', data);
  }
}
