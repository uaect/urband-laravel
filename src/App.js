import React , { Component } from 'react'
import Header from './components/header/header'
import Footer from './components/Footer/footer.component'
import HomePage from './components/Pages/home.component'
import WhoWeAre from './components/Pages/who-we-are.component'
import Event from './components/Pages/event.component'
import Artist from './components/Pages/artist.component'
import Contact from './components/Pages/contact.component'
import './assets/intro/css/intro.css';
import './assets/css/app.css';
import { Route, Link, BrowserRouter as Router, Switch } from 'react-router-dom'
class App extends Component{  //React.Component we can use on import on top

  render(){
    
    return (
      <Router>
        <div className="AppContainer hero-site">
          <Header />
              <Switch>
              <Route exact path="/app" component={HomePage} />
              <Route path="/who-we-are" component={WhoWeAre} />
              <Route path="/event" component={Event} />
              <Route path="/artist" component={Artist} />
              <Route path="/contact" component={Contact} />
              <HomePage/>
              <WhoWeAre/>
              <Event/>
              <Artist/>
              <Contact/>
            </Switch>
          <Footer/>
         </div>
      </Router>
    );
  }
}



export default App;
