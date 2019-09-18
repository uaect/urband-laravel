import React , {Component} from 'react';
import { Link, NavLink } from 'react-router-dom'
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
                    <NavLink to="/" className="logo-main">
                        <img src={Logo}/>
                    </NavLink>
                    </div>
                    <div className="nav">
                        <ul className="group" id="header-menu-magic-line">
                        <li>
                        <NavLink exact to="/index" activeClassName="selected" className="in-array">
                           Home 
                        </NavLink>
                        </li>
                        <li className="menu-item-has-children">
                        <NavLink to="/" className="in-array">
                            About   
                            <ul className="sub-menu">
                            <li><NavLink exact to="/who-we-are" activeClassName="selected">Who we are</NavLink></li>
                            <li><NavLink exact to="/what-we-do" activeClassName="selected">what we do</NavLink></li>
                            <li><NavLink exact to="/gang">the gang</NavLink></li>
                            </ul>

                        </NavLink>
                        </li>
                        <li className="menu-item-has-children">
                        <NavLink exact to="/event" activeClassName="selected" className="in-array">Events
						</NavLink>			
						</li>
                        
								<li className="menu-item-has-children">
                                <NavLink exact to="/"  className="in-array">Studio
										<ul className="sub-menu">
										<li><Link to="/artist">Artists</Link></li>
										<li><Link to="/clients">Clients</Link></li>
										</ul>
								</NavLink>	
								</li>

								<li className="menu-item-has-children">
                                <NavLink exact to="/radio"  className="in-array">Radio</NavLink>
									
								</li>
								
								
								<li className="menu-item-has-children">
                                <Link to="/"  className="in-array">Blog</Link>
									
								</li>
								<li><NavLink exact to="/gallery" activeClassName="selected" className="in-array">Gallery</NavLink></li>
								<li className="menu-item-has-children">
                                <NavLink to="/" className="in-array">Purchase
									<ul className="sub-menu">
									<li><a href="#">Event Tickets</a></li>
									<li><a href="#">Studio Bookings</a></li>
									<li><a href="#">Merchandise</a></li>
									</ul>
                                </NavLink>
								</li>
								<li className="menu-item-has-children">
                                <NavLink exact to="/contact" className="in-array" activeClassName="selected">Contact</NavLink>
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




