import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {
  loginForm: FormGroup;
  submitted = false;
  errorMsg = '';

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
      const payload = {
        username: this.loginForm.value.username,
        password: this.loginForm.value.password
      };
      console.log('ส่งข้อมูลไป backend:', payload);
      this.http.post<any>(
        'http://localhost:8000/api/login_post',
        payload,
        { withCredentials: true } // สำคัญสำหรับ session/cookie
      ).subscribe({
        next: (res) => {
          if (res.success) {
            // Redirect ไป about
            this.router.navigate(['/about']);
          } else {
            this.errorMsg = res.message || 'Login failed';
          }
        },
        error: (err) => {
          this.errorMsg = err.error?.message || 'Login failed';
        }
      });
    }
  }
}