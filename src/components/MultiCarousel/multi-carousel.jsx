
import React, { Component } from 'react'
import Carousel from "react-multi-carousel";
import "react-multi-carousel/lib/styles.css";
import artist1 from '../../media/artist/1.jpg';



class multiCarouselHero extends Component{

	
    render(){
		const responsive = {
			superLargeDesktop: {
			  // the naming can be any, depends on you.
			  breakpoint: { max: 4000, min: 3000 },
			  items: 5,
			},
			desktop: {
				breakpoint: { max: 3000, min: 1024 },
				items: 5,
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
            <section className="section-padding-two artist-lineup">
                <div className="tim-container clearfix">
                    <ul>
            			<Carousel responsive={responsive}>
           
						<li className="artist-single clearfix swiper-slide">
							<img src={artist1} alt=""/>
							<div className="artist-single-content">
							
								<h6>James Hetfield</h6>
								<p>Band: Metallica</p>
							</div>
						</li>
                        <li className="artist-single clearfix swiper-slide">
							<img src={artist1} alt=""/>
							<div className="artist-single-content">
							
								<h6>James Hetfield</h6>
								<p>Band: Metallica</p>
							</div>
						</li>
                        <li className="artist-single clearfix swiper-slide">
							<img src={artist1} alt=""/>
							<div className="artist-single-content">
							
								<h6>James Hetfield</h6>
								<p>Band: Metallica</p>
							</div>
						</li>
                        <li className="artist-single clearfix swiper-slide">
							<img src={artist1} alt=""/>
							<div className="artist-single-content">
							
								<h6>James Hetfield</h6>
								<p>Band: Metallica</p>
							</div>
						</li>
                        <li className="artist-single clearfix swiper-slide">
							<img src={artist1} alt=""/>
							<div className="artist-single-content">
							
								<h6>James Hetfield</h6>
								<p>Band: Metallica</p>
							</div>
						</li>
                        <li className="artist-single clearfix swiper-slide">
							<img src={artist1} alt=""/>
							<div className="artist-single-content">
							
								<h6>James Hetfield</h6>
								<p>Band: Metallica</p>
							</div>
						</li>
                       
                        
              
            </Carousel>
            </ul>
            </div>
            </section>
        
        );
    }
}

export default multiCarouselHero;
