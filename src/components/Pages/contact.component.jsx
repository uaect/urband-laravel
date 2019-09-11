import React , {Component} from 'react';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faAt,faMapMarkerAlt,faPhoneAlt } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { Link } from 'react-router-dom'
import { withScriptjs, withGoogleMap, GoogleMap, Marker } from "react-google-maps"

library.add(faAt,faMapMarkerAlt,faPhoneAlt)

const MyMapComponent = withScriptjs(withGoogleMap((props) =>
  <GoogleMap
    defaultZoom={8}
    defaultCenter={{ lat: -34.397, lng: 150.644 }}
  >
    {props.isMarkerShown && <Marker position={{ lat: -34.397, lng: 150.644 }} />}
  </GoogleMap>
))

class Contact extends React.Component{


    render(){

        return (
           
         <div>
                <section className="page-header artist-banner">
                    <div className="tim-container">
                        <div className="page-header-title text-center">
                        <h3>Get with us</h3>
                        <h2>Contact</h2>
                        </div>

                        <div className="breadcrumbs">
                        <Link to="/">Home</Link>
                            <span>/</span>
                            <span>Contact</span>
                        </div>

                    </div>
		
                </section>

                <MyMapComponent
                isMarkerShown
                googleMapURL="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=geometry,drawing,places"
                loadingElement={<div style={{ height: `100%` }} />}
                containerElement={<div style={{ height: `400px` }} />}
                mapElement={<div style={{ height: `100%` }} />}
                />


                <section className="contact-info">
			<div className="container-fluid no-pad">
				<div className="contact-info-inner">
					<div className="row no-gutters">
						<div className="col-md-4">
							<div className="email-info sin-cont-info d-flex align-items-center">
								<div className="center-wrap">
                                    <FontAwesomeIcon icon={faAt} className="ico" />
									<h3>Email Us</h3>
									<p>Mail:<a href="mailto:name@email.com">info@yoursite.com</a></p>
									<a href="mailto:name@email.com">info@yoursite.com</a>
								</div>

							</div>
						</div>
					
						<div className="col-md-4">
							<div className="office-location sin-cont-info d-flex align-items-center">
								<div className="center-wrap">
                                 <FontAwesomeIcon icon={faMapMarkerAlt}  className="ico"/>
									<h3>office location</h3>
									<p>Address: WE54, New York Queens, NY 12121.</p>
								</div>
							</div>
						</div>
				
						<div className="col-md-4">
							<div className="call-us sin-cont-info d-flex align-items-center">
								<div className="center-wrap">
                                    <FontAwesomeIcon icon={faPhoneAlt} className="ico"/>
									<h3>call Us</h3>
									<p>Phone: <a href="tel:158-659-8546">158-659-8546</a></p>
									<a href="tel:158-659-8546">158-659-8546</a>
								</div>
							</div>
						</div>
					

					</div>
				</div>
			
			</div>
		
		</section>

        <section className="contuct-bottom section-padding">
			<div className="container">
				<div className="row justify-content-center">
					<div className="col-md-10 col-lg-8">
						<div className="con-bottom-inner">
							<h4>CONTACT US</h4>
							<p>Dummy text of the printing and typesetting industry. Lorem Ipsum has been the </p>
							<div className="con-page-form">
								<textarea name="message" placeholder="Message"></textarea>
								<input type="text" placeholder="Name *" className="mar-r"/>
								<input type="text" placeholder="Email *"/>
								<input value="Submit" type="submit"/>
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

export default Contact;




