
import React, { Component } from 'react'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlay } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import './play-animation-component.css'
import cover from '../../media/album/cover.jpg';
import record from '../../media/background/record.png';
import recordshade from '../../media/background/record-shade.png';
import playerkey from '../../media/background/player-key.png';

library.add(faPlay)

class playAnimation extends Component{


    render(){
        return (    
            <section className="section-padding latest-relese">
			<div className="container">
				<div className="row">
					<div className="section-title style-four">
						<h2>LATEST RELEASE</h2>
					</div>
					<div className="d-flex justify-content-center">
						<div className="col-xl-10" id="moving-player">
							<div className="row">
								<div className="col-sm-8 col-md-9 col-lg-8">
									<div className="latest-album-left">
										<div className="cover-img">
											<img src={cover} alt=""/>
										</div>
										<div className="albun-details">
											<h6>ALBUM INFO</h6>
											<p>Most happening band Blood Chain recently has released their debut album called
												<span>“HEAVEN”</span>. Officialy the album released on May 19, 2018 in Harmonik Studio, Venice. This <span>Alternative Rock</span> Band made 12 songs with total 36:20 minutes timeline.</p>
											<p>The Lineup: Tony McAlpine (Guitars), Jhon Lennon (Vocal & Guitars), Mike Portnoy (Drums), Billy Shehan (Bass Guitars), Chester Krain (Keys).</p>
										</div>
									</div>

								</div>
								<div className="col-sm-4 col-md-3 col-lg-4">
									<div className="latest-album-right">
										<h6>LISTEN DEMO NOW</h6>
										<div className="latest-album-btn">
											<a href="#" className="sm2_button"><FontAwesomeIcon icon={faPlay} /></a>
										</div>

									</div>
								</div>
								<div className="col-xl-12">
									<div className="record-player">
										<div className="player-main">
											<img src={record} alt=""/>
										</div>
										<div className="player-main-shade">
											<img src={recordshade} alt=""/>
										</div>
										<div className="record-key">
											<img src={playerkey} alt=""/>
										</div>
									</div>

								</div>




								
							</div>
						</div>
					</div>
				
				</div>
				
			</div>
			
		</section>
                      
        
        );
    }
}
export default playAnimation;
