import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class PaymentService {
  constructor(private http: HttpClient) {}

  zalopay(data: any) {
    return this.http.post('http://localhost:8000/api/zalopay', data, {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    });
  }

  vnpay(data: any) {
    return this.http.post('http://localhost:8000/api/vnpay', data, {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    });
  }

  momo(data: any) {
    return this.http.post('http://localhost:8000/api/momo', data, {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    });
  }

  vnpayReturn(data: any) {
    return this.http.post('http://localhost:8000/api/vnpay-return', data);
  }

  zalopayReturn(data: any) {
    return this.http.post('http://localhost:8000/api/zalopay-return', data, {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    });
  }
}
