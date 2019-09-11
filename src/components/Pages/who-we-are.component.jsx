import React , {Component} from 'react';

class WhoWeAre extends React.Component{


    render(){

        return (

			<section id="event-about">
				<div className="container">
					<div className="row">
						<div className="col-lg-5">
							<div className="event-thumb">
							<img src={ require('../../media/banner/1.png')} alt="Thumb"/>
							</div>
						</div>
						<div className="col-lg-7 about-box">
						<div className="section-title style-four">
							<h2>About Us</h2>
							<p>There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration in some injected humour.</p>
						</div>
					</div>
					</div>
				</div>
			</section>		

           
           
        );
    }
}

export default WhoWeAre;




