import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { MatCardModule } from '@angular/material/card';
import { MatIconModule } from '@angular/material/icon';
import { MatButtonModule } from '@angular/material/button';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { provideAnimationsAsync } from '@angular/platform-browser/animations/async';
import { RegistrationComponent } from './registration/registration.component';
import {NgOptimizedImage} from "@angular/common";
import {FormsModule} from "@angular/forms";
import {HttpClientModule} from "@angular/common/http";

@NgModule({
  imports: [
    BrowserModule,
    BrowserAnimationsModule,
    FormsModule,
    MatCardModule,
    MatIconModule,
    MatButtonModule,
    NgOptimizedImage,
    HttpClientModule
  ],
  declarations: [
    AppComponent,
    RegistrationComponent,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
