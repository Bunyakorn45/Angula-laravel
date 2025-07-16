import { Routes } from '@angular/router';

export const routes: Routes = [
  {
    path: '',
    loadComponent: () => import('./components/login/login.component').then(m => m.LoginComponent)
  },
  {
    path: 'about',
    loadComponent: () => import('./components/about/about.component').then(m => m.AboutComponent)
  },

  {
    path: 'certificate',
    loadComponent: () => import('./components/certificate/certificate.component').then(m => m.CertificateComponent)
  }
];