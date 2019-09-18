import React , {Component} from 'react';
import { Link } from 'react-router-dom'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faMixcloud} from '@fortawesome/free-brands-svg-icons' 
import { faGlassCheers,faMicrophone } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'

library.add(faGlassCheers,faMixcloud,faMicrophone)
class WhoWeAre extends React.Component{


    render(){

        return (

			<div>
			 <section className="page-header artist-banner about">
                    <div className="tim-container">
                        <div className="page-header-title text-center">
                        <h2>Who we are</h2>
                        </div>

                        <div className="breadcrumbs">
                        <Link to="/">Home</Link>
                            <span>/</span>
                            <span>About</span>
                        </div>

                    </div>
            </section>	

			<section id="event-about">
				<div className="container">
					<div className="row">
						<div className="section-title style-four">
						<h2>LONG STORY SHORT</h2>
						<p>Melbourne is the coastal capital of the southeastern Australian state of Victoria. At the city's centre is the modern Federation Square development,
							 with plazas, bars, and restaurants by the Yarra River. In the Southbank area, 
							the Melbourne Arts Precinct is the site of Arts Centre Melbourne and the National Gallery of Victoria, with Australian and indigenous art..</p>
						<Link to="/" className="tim-btn hero">Subscribe Us</Link>
						</div>
					</div>
					<div className="row">
						<div className="col-12 text-center">
                        <div className="band-img">
                            <img className="img-responsive"src={require('../../media/about/about.jpg')} alt="About Band Image"/>
                        </div>
                    </div>
						</div>
				</div>
			</section>	

			<section className="black-bg side-img-section what-we-do-section">
			<div class="col-sm-6 col-sm-offset-6 side-img d-none d-md-block"></div>
				<div className="container">
					<div className="row">
					<div className="col-md-5 col-12">
                        <div className="doing-items section-padding">
                            <div className="doing-item">
                                <div className="doing-icon">
									<FontAwesomeIcon icon={faMixcloud} className="doing-icon" />
                                </div>
                                <h4 className="doing-title">Party Song</h4>
                                <p className="doing-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut Lorem ipsum dolor sit amet,</p>
                            </div>
							<div className="doing-item">
                                <div className="doing-icon">
									<FontAwesomeIcon icon={faGlassCheers} className="doing-icon" />
                                </div>
                                <h4 className="doing-title">Special Event</h4>
                                <p className="doing-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut Lorem ipsum dolor sit amet,</p>
                            </div>
							<div className="doing-item">
                                <div className="doing-icon">
									<FontAwesomeIcon icon={faMicrophone} className="doing-icon" />
                                </div>
                                <h4 className="doing-title">Live Concert</h4>
                                <p className="doing-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut Lorem ipsum dolor sit amet,</p>
                            </div>
						</div>
					</div>	
					</div>
				</div>
			</section>	

			</div>	

           
           
        );
    }
}

export default WhoWeAre;




