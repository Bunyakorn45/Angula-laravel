import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { Router } from '@angular/router';
import { MatProgressSpinnerModule } from '@angular/material/progress-spinner';
import { timeout } from 'rxjs/operators';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule, MatProgressSpinnerModule, HttpClientModule],
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {
  loginForm: FormGroup;
  submitted = false;
  errorMsg = '';
  loading = false;
  showSpinner = false;

  constructor(
    private fb: FormBuilder,
    private http: HttpClient,
    private router: Router
  ) {
    this.loginForm = this.fb.group({
      username: ['', Validators.required],
      password: ['', Validators.required]
    });
  }

  onSubmit() {
    this.submitted = true;
    this.errorMsg = '';
    if (this.loginForm.valid) {
      this.loading = true;
      this.showSpinner = true;
      const payload = {
        username: this.loginForm.value.username,
        password: this.loginForm.value.password
      };
      this.http.post<any>(
        'http://localhost:8000/api/login_post',
        payload,
        { withCredentials: true }
      )
      .pipe(timeout(5000)) // เพิ่ม timeout 5 วินาที
      .subscribe({
        next: (res) => {
          this.loading = false;
          if (res.success) {
            this.showSpinner = false;
            const user = {
              username: res.username,
              id_user: res.id_user
            };
            localStorage.setItem('user', JSON.stringify(user));
            this.router.navigate(['/about']);
          } else {
            setTimeout(() => {
              this.showSpinner = false;
              this.errorMsg = res.message && res.message.trim() !== ''
                ? res.message
                : 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
            }, 1000);
          }
        },
        error: (err) => {
          this.loading = false;
          setTimeout(() => {
            this.showSpinner = false;
            // ถ้า timeout หรือ error อื่น ๆ
            if (err.name === 'TimeoutError') {
              this.errorMsg = 'เซิร์ฟเวอร์ไม่ตอบสนอง กรุณาลองใหม่อีกครั้ง';
            } else {
              this.errorMsg = err.error?.message && err.error?.message.trim() !== ''
                ? err.error.message
                : 'เกิดข้อผิดพลาดในการเข้าสู่ระบบ';
            }
          }, 1000);
        }
      });
    }
  }
}