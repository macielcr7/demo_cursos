import { Component } from '@angular/core';
import { Platform } from 'ionic-angular';
import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';

import { HomePage } from '../pages/home/home';
@Component({
  templateUrl: 'app.html'
})
export class MyApp {
  rootPage:any = HomePage;

  constructor(platform: Platform, statusBar: StatusBar, splashScreen: SplashScreen) {
    platform.ready().then(() => {
      if(platform.is('ios')){
          statusBar.overlaysWebView(false);
      }
      else{
          statusBar.styleLightContent();
      }
      statusBar.backgroundColorByHexString('#416e6d');
      splashScreen.hide();
      
      let body = document.body;body.classList.add('loaded');
    });

  }
}

