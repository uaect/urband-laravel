import React , {Component} from 'react';
import { Link } from 'react-router-dom'
import Carousel from "react-multi-carousel";

class Event extends React.Component{


    render(){

        const responsive = {
			superLargeDesktop: {
			  // the naming can be any, depends on you.
			  breakpoint: { max: 4000, min: 3000 },
			  items: 4,
			},
			desktop: {
				breakpoint: { max: 3000, min: 1024 },
				items: 4,
			  },
			  tablet: {
				breakpoint: { max: 1024, min: 464 },
				items: 2,
			  },
			  mobile: {
				breakpoint: { max: 464, min: 0 },
				items: 1,
			  },
			};

        return (
           
         <div>

            <section className="page-header event-header">
			<div className="tim-container">
				<div className="page-header-title event-page-header text-center">
					<h2>Music Conference 2018</h2>
					<h3>10 - 12 DECEMBER, 2019, DUBLIN</h3>

					<Link to="/" className="tim-btn tim-btn-bgt">Buy Now</Link>
				</div>

				<div className="breadcrumbs">
					<Link to="/">Home</Link>
					<span>/</span>
					<span>Events</span>
				</div>

			</div>
			
		</section>      



        <section id="event-about">
			<div className="container">
				<div className="row">
					<div className="col-lg-6">
						<div className="event-thumb">
                        <img src={ require('../../media/about/4.jpg')} alt="Thumb"/>
						</div>
					</div>
				

					<div className="col-lg-6">
						<div className="event-content">
							<h2>
								Optimization <span>Is Important</span><br/> To <em>Business Succes.</em>
							</h2>

							<p>
								There are many variations of passages th of Lorem Ipsum available but is a the majority have suffered alteration in some form, by injected humour believable dummy.
							</p>

							<div className="event-details">
								<p><span>Date & Time:</span> December 27, 2018 At 8:00 Am To December 31, 2018 At 10:00 Am </p>

								<p>
									<span>Location:</span> Indoor Stadium 02 , Singapore
								</p>
							</div>

							<h4>Concert Introduction</h4>
							<p>
								There are many variations of passages of Lorem Ipsum available, but is the majoriyty have suffered the a alteration in some form, by injected a humour or randomised words which don't look even slightly an that is believable. There are many variations
								of passages of Lorem Ipsum the a available, but the majority.
							</p>

							<Link to="/" className="tim-btn">Buy Tickets</Link>

						</div>
			
					</div>
		
				</div>
			
			</div>
		
		</section>

        <section id="event-schedule" className="clearfix">

			<div className="schedule-ticket">
				<img src={require('../../media/background/10.jpg')} alt="thum"/>

				<div className="content">
					<p className="schedule-date">August 19, 2018 @ 11 - 30 am</p>
					<h3>
						If You Can Drem It,<br/> You Cane Live It
					</h3>

					<Link to="/" className="tim-btn">Buy Ticket</Link>
				</div>
			</div>



			<div className="schedule clearfix">
				<div className="swiper-container">

					<div className="swiper-wrapper">
                       
						<div className="swiper-slide">
                     
                    	<Carousel responsive={responsive}>
                        <li>
							<div className="schedule-item">
								<div className="schedule-thumb">
									<img src={require('../../media/schedule/1.jpg')} alt="thumb"/>
								</div>
                                <h4 className="sch-time">10 am - 11 am</h4>

                                <h3 className="band-name">Brand Name 2018</h3>

                                <p className="duration">Durations: 60, - Tracks: 5 songs</p>
                            </div>
                            </li> 
                            <li>
							<div className="schedule-item">
								<div className="schedule-thumb">
									<img src={require('../../media/schedule/1.jpg')} alt="thumb"/>
								</div>
                                <h4 className="sch-time">10 am - 11 am</h4>

                                <h3 className="band-name">Brand Name 2018</h3>

                                <p className="duration">Durations: 60, - Tracks: 5 songs</p>
                            </div>
                            </li> 
                            
                            <li>
							<div className="schedule-item">
								<div className="schedule-thumb">
									<img src={require('../../media/schedule/1.jpg')} alt="thumb"/>
								</div>
                                <h4 className="sch-time">10 am - 11 am</h4>

                                <h3 className="band-name">Brand Name 2018</h3>

                                <p className="duration">Durations: 60, - Tracks: 5 songs</p>
                            </div>
                            </li> 
                            
                            <li>
							<div className="schedule-item">
								<div className="schedule-thumb">
									<img src={require('../../media/schedule/1.jpg')} alt="thumb"/>
								</div>
                                <h4 className="sch-time">10 am - 11 am</h4>

                                <h3 className="band-name">Brand Name 2018</h3>

                                <p className="duration">Durations: 60, - Tracks: 5 songs</p>
                            </div>
                            </li> 
                            <li>
							<div className="schedule-item">
								<div className="schedule-thumb">
									<img src={require('../../media/schedule/1.jpg')} alt="thumb"/>
								</div>
                                <h4 className="sch-time">10 am - 11 am</h4>

                                <h3 className="band-name">Brand Name 2018</h3>

                                <p className="duration">Durations: 60, - Tracks: 5 songs</p>
                            </div>
                            </li> 
                            
                            
                            </Carousel>
                         
                        </div>   
                  
                    </div>        
                </div>               
            </div>        
		</section>


       
				

	
		</div>
           
           
        );
    }
}

export default Event;




