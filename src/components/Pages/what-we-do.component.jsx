import React , {Component} from 'react';
import PreviousShowHome from '../PreviousShows/previous-show.component'
import { Link } from 'react-router-dom'

class WhatweDo extends React.Component{

    render(){

        return (
           
         <div>
            
                <section className="page-header artist-banner">
                    <div className="tim-container">
                        <div className="page-header-title text-center">
                        <h3>Delivering creative event and brand experiences</h3>
                        <h2>What We Do</h2>
                        </div>

                        <div className="breadcrumbs">
                        <Link to="/">Home</Link>
                            <span>/</span>
                            <span>What We Do</span>
                        </div>

                    </div>
		
                </section>

            <div className="page-padd">
                <div class="container">
                        <div className="section-title style-four text-center">
                            <h2>Let's Do It</h2>
                        </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <section className="services-grid">
                                <header>
                                <h1>Entertainment</h1>
                                </header>

                                <div className="content">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis rem voluptates, 
                                     animi amet dolorem tenetur veritatis? Sapiente!</p>

                                     <button className="tim-btn">View More</button>
                                </div>
                            </section>

                        </div>
                        <div class="col-lg-4">
                            <section className="services-grid">
                                <header>
                                <h1>Event Theming</h1>
                                </header>

                                <div className="content">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis rem voluptates, 
                                     animi amet dolorem tenetur veritatis? Sapiente!</p>
                                     <button className="tim-btn">View More</button>
                                </div>
                            </section>

                        </div>
                        <div class="col-lg-4">
                            <section className="services-grid">
                                <header>
                                <h1>Concerts & Festivals</h1>
                                </header>

                                <div className="content">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis rem voluptates, 
                                     animi amet dolorem tenetur veritatis? Sapiente!</p>
                                     <button className="tim-btn">View More</button>
                                </div>
                            </section>

                        </div>
                        <div class="col-lg-4">
                            <section className="services-grid">
                                <header>
                                <h1>Recording</h1>
                                </header>

                                <div className="content">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis rem voluptates, 
                                     animi amet dolorem tenetur veritatis? Sapiente!</p>
                                     <button className="tim-btn">View More</button>
                                </div>
                            </section>

                        </div>
                        <div class="col-lg-4">
                            <section className="services-grid">
                                <header>
                                <h1>Production</h1>
                                </header>

                                <div className="content">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis rem voluptates, 
                                     animi amet dolorem tenetur veritatis? Sapiente!</p>
                                     <button className="tim-btn">View More</button>
                                </div>
                            </section>

                        </div>
                        <div class="col-lg-4">
                            <section className="services-grid">
                                <header>
                                <h1>Post Production</h1>
                                </header>

                                <div className="content">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis rem voluptates, 
                                     animi amet dolorem tenetur veritatis? Sapiente!</p>
                                     <button className="tim-btn">View More</button>
                                </div>
                            </section>

                        </div>
                    </div>
                        <div className="row services-secton-two">
                        <PreviousShowHome/>
                        </div>
                </div>
                

            </div>

      
       
				

	
		</div>
           
           
        );
    }
}

export default WhatweDo;




