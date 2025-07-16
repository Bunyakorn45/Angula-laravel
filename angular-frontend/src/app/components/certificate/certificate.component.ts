import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import * as XLSX from 'xlsx';

interface CertificateData {
  id: number;
  competition_category: string;
  competition_level: string;
  award: string;
  school_name: string;
  participant_names: string[];
  award_year: number;
}

@Component({
  selector: 'app-certificate',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './certificate.component.html',
  styleUrls: ['./certificate.component.scss']
})

export class CertificateComponent {
  data: CertificateData[] = [
    // ตัวอย่างข้อมูล
    {
      id: 1,
      competition_category: 'อ่านอขยานทำนองเสนาะ',
      competition_level: 'ประถมศึกษา',
      award: 'ชนะเลิศ',
      school_name: 'โรงเรียนบางคูเวียงใหม่',
      participant_names: ['สมชาย ใจดี', 'สมหญิง ขยัน'],
      award_year: 2025,
    },
    // เพิ่มข้อมูลได้ตามต้องการ
  ];

  previewData: CertificateData | null = null;

  onUpload(event: Event) {
    // TODO: handle file upload and parse Excel/CSV
    alert('ฟีเจอร์อัปโหลดยังไม่พร้อมใช้งาน');
  }

  openPreview(item: CertificateData) {
    this.previewData = item;
  }

  closePreview() {
    this.previewData = null;
  }

  generateAllCertificates() {
    alert('ฟีเจอร์สร้างเกียรติบัตรทั้งหมดยังไม่พร้อมใช้งาน');
  }
}