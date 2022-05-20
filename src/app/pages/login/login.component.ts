import { Component, OnInit, OnDestroy } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit, OnDestroy {
  form: FormGroup
  loading = false;
  error_user_incorrecto= false;

  constructor(private fb: FormBuilder, private router: Router) {
    this.form = this.fb.group({
      usuario: ['', Validators.required],
      password: ['', Validators.required]
    })
   }

  ngOnInit(): void {
  }
  Ingresar(){
    const usuario = this.form.value.usuario;
    const password = this.form.value.password;

    //Acá va la comprobación con el back-end de las credenciales
    //*placeholder local
    if(usuario == 'Admin' && password == '1234'){
      //Redireccionamos  al dashboard
      this.fakeloading();
    }else{
      //Mostramos un mensaje de error
      this.error();
      this.form.reset();
    }
  }
  error(){
    this.error_user_incorrecto = true;
  }

  fakeloading(){
    this.loading = true;
    setTimeout(() => {

      //Redireccionamos  al dashboard
      this.router.navigate(['dashboard']);
      //this.loading = false;
    }, 1500);
  }
  ngOnDestroy() {
  }

}
