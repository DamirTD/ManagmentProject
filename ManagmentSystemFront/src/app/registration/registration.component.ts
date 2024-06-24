import { Component } from '@angular/core';
import { RegistrationService } from '../../services/registration/registration.service';

@Component({
  selector: 'app-registration',
  templateUrl: './registration.component.html',
  styleUrls: ['./registration.component.scss']
})
export class RegistrationComponent {
  selectedGender: 'male' | 'female' | null = null;
  age: number | undefined;
  firstName: string | undefined;
  lastName: string | undefined;
  email: string | undefined;
  phoneNumber: string | undefined;
  showContactInfo = false;
  formSubmitted = false;
  password: string | undefined;

  constructor(private registrationService: RegistrationService) { }

  selectGender(gender: 'male' | 'female'): void {
    this.selectedGender = gender;
  }

  nextStep(): void {
    this.showContactInfo = true;
  }

  send(): void {
    const user = {
      gender: this.selectedGender,
      age: this.age,
      firstName: this.firstName,
      lastName: this.lastName,
      email: this.email,
      phoneNumber: this.phoneNumber,
      password: this.password
    };

    this.registrationService.register(user).subscribe(response => {
      console.log('Registration successful:', response);
      this.formSubmitted = true;
      this.selectedGender = null;
      this.age = undefined;
      this.firstName = undefined;
      this.lastName = undefined;
      this.showContactInfo = false;
      this.email = undefined;
      this.phoneNumber = undefined;
      this.password = undefined;
    }, error => {
      console.error('Registration failed:', error);
    });
  }
}
