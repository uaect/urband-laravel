import React, { Component } from 'react'
import ModalVideo from '../VideoModal/video-modal.component';
import './spot-light.component.css'
class spotLight extends Component {
 
   
   
    render () {
      return (
        <section className="section-padding-two wide_line_bg">
			<div className="container">
				<div className="d-flex justify-content-center row">
					<div className="col-xl-10">
						<div className="section-title style-five">
							<h2>SPOTLIGHT</h2>
							<p>There are many variations of passages of Lorem Ipsum available but the majority.</p>
						</div>
						<div className="row">
							<div className="grid-60">
								<div className="spotlight-inner">
									<img src={require('../../media/performance/vid-1.jpg')} alt=""/>
									<div className="video-player-three">
										
									
										<div className="text">
											<p>Show Stoppers Time</p>
											<span>(Live in Tokyo, 2017)</span>
										</div>
									</div>
								</div>
							</div>
							
							<div className="grid-40">
								<div className="subscribe-two">
									<div className="section-title style-five">
										<h2>SUBSCRIBE</h2>
										<p>There are many variations of passages of Lorem Ipsum available but the majority.</p>
									</div>
									<form action="#">
										<input placeholder="Enter Your Email" type="text"/>
										<button type="submit" className="submit">send me</button>
									</form>
								</div>
								
							</div>
							
						</div>
					
					</div>
				
				</div>
                <ModalVideo/> 
				
			</div>
			
		</section>
        
          
	
	
			
	
         
       
          
        
      )
    }
  }
  export default spotLight;