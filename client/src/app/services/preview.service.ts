import { HttpBackend, HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class PreviewService {
  constructor(private http: HttpClient) {}

  getPreviewByProduct(idproduct: any) {
    return this.http.get(`http://localhost:8000/api/preview/${idproduct}`);
  }

  createPreview(data: any) {
    return this.http.post(`http://localhost:8000/api/preview`, data);
  }

  updatePreview(data: any, id: any) {
    return this.http.put(`http://localhost:8000/api/preview/${id}`, data);
  }
}
