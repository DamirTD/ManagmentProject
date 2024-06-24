import { ComponentFixture, TestBed } from '@angular/core/testing';

import { RegistrationComponent } from './registration.component';
import {MatIconModule} from "@angular/material/icon";
import {NoopAnimationsModule} from "@angular/platform-browser/animations";
import {MatCardModule} from "@angular/material/card";

describe('RegistrationComponent', () => {
  let component: RegistrationComponent;
  let fixture: ComponentFixture<RegistrationComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [RegistrationComponent],
      imports: [
        MatCardModule,
        MatIconModule,
        NoopAnimationsModule // используем для отключения анимаций во время тестов
      ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(RegistrationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });

  it('should display male icon and text', () => {
    const maleCard = fixture.nativeElement.querySelector('.gender-card:first-child');
    const maleIcon = maleCard.querySelector('mat-icon');
    const maleText = maleCard.querySelector('p');

    expect(maleIcon.textContent).toContain('man');
    expect(maleText.textContent).toBe('Male');
  });

  it('should display female icon and text', () => {
    const femaleCard = fixture.nativeElement.querySelector('.gender-card:last-child');
    const femaleIcon = femaleCard.querySelector('mat-icon');
    const femaleText = femaleCard.querySelector('p');

    expect(femaleIcon.textContent).toContain('woman');
    expect(femaleText.textContent).toBe('Female');
  });
});
