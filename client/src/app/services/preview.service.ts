import { HttpBackend, HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root',
})
export class PreviewService {
  private apiUrl = environment.apiUrl;

  constructor(private http: HttpClient) {}

  getPreviewByProduct(idproduct: any) {
    return this.http.get(`${this.apiUrl}/api/preview/${idproduct}`);
  }

  createPreview(data: any) {
    return this.http.post(`${this.apiUrl}/api/preview`, data);
  }

  updatePreview(data: any, id: any) {
    return this.http.put(`${this.apiUrl}/api/preview/${id}`, data);
  }
}
