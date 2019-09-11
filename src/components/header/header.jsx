import React , {Component} from 'react';
import { Link } from 'react-router-dom'
import '../header/header.component.css';
import Logo from '../../assets/img/logo_5.png';

class Header extends React.Component{


    render(){
        return (

        <div className="AppHeader">
            <header className="header header-magic-line headroom headroom--not-bottom headroom--pinned headroom--top">
                <div className="tim-container clearfix">
                <div className="header-magic-line-inner clearfix">
                    <div id="site-logo" className="float-left">
                    <Link to="/" className="logo-main">
                        <img src={Logo}/>
                    </Link>
                    </div>
                    <div className="nav">
                        <ul id="header-menu-magic-line">
                        <li>
                        <Link to="app">
                           Home 
                        </Link>
                        </li>
                        <li className="menu-item-has-children">
                        <Link to="/">
                            About   
                            <ul className="sub-menu">
                            <li><Link to="/who-we-are">Who we are</Link></li>
                            <li><Link to="/">what we do</Link></li>
                            <li><Link to="/">the gang</Link></li>
                            </ul>

                        </Link>
                        </li>
                        <li className="menu-item-has-children">
                        <Link to="event">Events
						</Link>			
						</li>
                        
								<li className="menu-item-has-children">
                                <Link to="/">Studio
										<ul className="sub-menu">
										<li><Link to="/artist">Artists</Link></li>
										<li><a href="#">Clients</a></li>
										</ul>
								</Link>	
								</li>

								<li className="menu-item-has-children">
                                <Link to="/">Radio</Link>
									
								</li>
								
								
								<li className="menu-item-has-children">
                                <Link to="/">Blog</Link>
									
								</li>
								<li><Link to="/">Gallery</Link></li>
								<li className="menu-item-has-children">
                                <Link to="/">Purchase
									<ul className="sub-menu">
									<li><a href="#">Event Tickets</a></li>
									<li><a href="#">Studio Bookings</a></li>
									<li><a href="#">Merchandise</a></li>
									</ul>
                                </Link>
								</li>
								<li className="menu-item-has-children">
                                <Link to="contact">Contact</Link>
								</li>
                        </ul>
                    </div>
                    
                    </div>  
                </div>
            </header>
        </div>
           
        );
    }
}

export default Header;




