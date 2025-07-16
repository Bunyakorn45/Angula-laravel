import { Component, ViewChild } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule, Router } from '@angular/router';
import { MatToolbarModule } from '@angular/material/toolbar';
import { MatButtonModule } from '@angular/material/button';
import { MatSidenavModule, MatSidenav } from '@angular/material/sidenav';
import { MatIconModule } from '@angular/material/icon';
import { MatDividerModule } from '@angular/material/divider';
import { NgClass } from '@angular/common';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [
    CommonModule,
    RouterModule,
    MatToolbarModule,
    MatButtonModule,
    MatSidenavModule,
    MatIconModule,
    MatDividerModule,
    NgClass
  ],
  template: `
  <div class="gov-app-bg">
    <mat-toolbar
      color="primary"
      class="gov-toolbar gov-toolbar-custom"
      [class.gov-toolbar-mini]="!sidenavOpened"
      *ngIf="!isLoginPage()"
    >
      <img src="assets/Totoro-Transparent-File.png" alt="ตราครุฑ" class="gov-toolbar-logo" />
      <span class="gov-toolbar-title">
        ระบบสารสนเทศกลาง
      </span>
      <span class="gov-toolbar-spacer"></span>
      <button mat-icon-button matTooltip="โปรไฟล์" routerLink="/profile">
        <mat-icon>account_circle</mat-icon>
      </button>
      <button mat-icon-button *ngIf="isLoggedIn()" (click)="logout()" matTooltip="ออกจากระบบ">
        <mat-icon>exit_to_app</mat-icon>
      </button>
    </mat-toolbar>

    <ng-container *ngIf="!isLoginPage(); else centerOutlet">
      <mat-sidenav-container class="gov-sidenav-container">
        <mat-sidenav #sidenav
          mode="side"
          [opened]="true"
          class="gov-app-sidenav"
          [ngClass]="{'gov-mini-sidenav': !sidenavOpened}">
          <div class="gov-sidenav-header">
            <button mat-icon-button (click)="toggleSidenav()">
              <mat-icon>menu</mat-icon>
            </button>
            <span class="gov-sidenav-title" *ngIf="sidenavOpened">เมนูหลัก</span>
          </div>
          <mat-divider></mat-divider>
          <div class="gov-sidenav-content">
            <a mat-button routerLink="/about" class="gov-sidenav-link" routerLinkActive="active">
              <mat-icon>security</mat-icon>
              <span *ngIf="sidenavOpened">หน้าแรก</span>
            </a>
            <a mat-button routerLink="/dashboard" class="gov-sidenav-link" routerLinkActive="active">
              <mat-icon>dashboard</mat-icon>
              <span *ngIf="sidenavOpened">แดชบอร์ด</span>
            </a>
            <a mat-button routerLink="/booking" class="gov-sidenav-link" routerLinkActive="active">
              <mat-icon>directions_car</mat-icon>
              <span *ngIf="sidenavOpened">จองยานพาหนะ</span>
            </a>
            <a mat-button routerLink="/my-bookings" class="gov-sidenav-link" routerLinkActive="active">
              <mat-icon>assignment</mat-icon>
              <span *ngIf="sidenavOpened">รายการจองของฉัน</span>
            </a>
            <a mat-button routerLink="/members" class="gov-sidenav-link" routerLinkActive="active">
              <mat-icon>group</mat-icon>
              <span *ngIf="sidenavOpened">รายชื่อสมาชิก</span>
            </a>
            <a mat-button routerLink="/report" class="gov-sidenav-link" routerLinkActive="active">
              <mat-icon>bar_chart</mat-icon>
              <span *ngIf="sidenavOpened">รายงาน</span>
            </a>
            <a mat-button routerLink="/settings" class="gov-sidenav-link" routerLinkActive="active">
              <mat-icon>settings</mat-icon>
              <span *ngIf="sidenavOpened">ตั้งค่าระบบ</span>
            </a>
            <a mat-button routerLink="/certificate" class="gov-sidenav-link" routerLinkActive="active">
              <mat-icon>bar_chart</mat-icon>
              <span *ngIf="sidenavOpened">ไปที่หน้าสร้างเกียรติบัตร</span>
            </a>
            <mat-divider *ngIf="sidenavOpened"></mat-divider>
            <button mat-button class="gov-sidenav-link" (click)="logout()" *ngIf="isLoggedIn() && sidenavOpened">
              <mat-icon>exit_to_app</mat-icon>
              <span>ออกจากระบบ</span>
            </button>
          </div>
        </mat-sidenav>
        <mat-sidenav-content [class.gov-with-sidenav]="sidenavOpened">
          <router-outlet></router-outlet>
        </mat-sidenav-content>
      </mat-sidenav-container>
    </ng-container>
    <ng-template #centerOutlet>
      <div class="center-router">
        <router-outlet></router-outlet>
      </div>
    </ng-template>
  </div>
`,
  styleUrls: ['./app.component.scss'],
})
export class AppComponent {
  @ViewChild('sidenav') sidenav?: MatSidenav;
  sidenavOpened = true;

  constructor(private router: Router) { }

  isLoginPage() {
    return this.router.url === '/';
  }

  toggleSidenav() {
    this.sidenavOpened = !this.sidenavOpened;
  }

  isLoggedIn() {
    return typeof window !== 'undefined' && !!localStorage.getItem('user');
  }

  logout() {
    if (typeof window !== 'undefined') {
      localStorage.removeItem('user');
      window.location.href = '/';
    }
  }
}