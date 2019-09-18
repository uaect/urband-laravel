import React , {Component} from 'react';
import Carousel from "react-multi-carousel";
import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlay } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { Link } from 'react-router-dom'

library.add(faPlay)


class Radio extends React.Component{


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
           
         <div>

            <section className="page-header artist-banner">
                    <div className="tim-container">
                        <div className="page-header-title text-center">
                        <h3>Broadcast</h3>
                        <h2>& RADIO</h2>
                        </div>

                        <div className="breadcrumbs">
                        <Link to="/">Home</Link>
                            <span>/</span>
                            <span>Radio</span>
                        </div>

                    </div>
		
                </section>

                <section className="section-padding album-info-wrapper">
			<div className="container">
				<div className="row single-album-info">

					<div className="col-md-6 padding-remove">
						<div className="single-album-image">
							<img src={require('../../media/album/17.jpg')} alt=""/>
						</div>
					</div>
					

					<div className="col-md-6 padding-remove album-detail">
						<div className="single-album-details">
							<div className="details-top">
								<h6>Life itself! The way</h6>
								<p>Established fact that a reader will be distracted by readable content of a page when looking at its lay poin usin Ipsum is tmore-or-less.</p>
							</div>

							<ul>
								<li>Albume <span>Single</span></li>
								<li>Artist<span>Bernard Adamus</span></li>
								<li>Release Day <span>March, 10th, 2018</span></li>
								<li>Genre <span>R&B,Jazz</span></li>
								<li>Produce By <span>ThemeIM Entertainment</span></li>
								<li>Number Of Track <span>16 Tracks</span></li>
							</ul>

							<div className="single-album-description">
								<h6>Album Description</h6>
								<p>Established fact that a reader will be distracted by readable content of a page when looking at its lay poin usin Ipsum is tmore-or-less specimen book. It has survived not only five centuries, but the leap electronic typesetting,</p>
							</div>

							
						</div>
					</div>
				

				</div>
				
			</div>
			
		</section>

        <section className="single-album-player section-padding">
			<div className="container">
				<div className="row">
					<div className="add-poster">
						<img src={require('../../media/about/add-poster.jpg')}/>
					</div>

              
                    <img src={require('../../media/album/player.jpg')}/>
              
                    <div className="jp-playlist style-fullwidth">
                        <div className="head">Upcoming Programs</div>
                        <ul>
                            <li className="jp-playlist-current style-fullwidth">
                                <div className="jp-album-me"><Link className="jp-playlist-item-remove">×</Link><Link  className="jp-playlist-item jp-playlist-current" tabindex="0">Happy Life 02 sdfsf<span className="jp-artist">by Derwood Spinks</span></Link></div>
                            </li>
                            <li className="jp-playlist-current style-fullwidth">
                                <div className="jp-album-me"><Link className="jp-playlist-item-remove">×</Link><Link  className="jp-playlist-item jp-playlist-current" tabindex="0">King Magicians <span className="jp-artist">by Derwood Spinks</span></Link></div>
                            </li>
                            <li className="jp-playlist-current style-fullwidth">
                                <div className="jp-album-me"><Link className="jp-playlist-item-remove">×</Link><Link  className="jp-playlist-item jp-playlist-current" tabindex="0">Leaving it Behind <span className="jp-artist">by Derwood Spinks</span></Link></div>
                            </li>
                            <li className="jp-playlist-current style-fullwidth">
                                <div className="jp-album-me"><Link className="jp-playlist-item-remove">×</Link><Link  className="jp-playlist-item jp-playlist-current" tabindex="0">Happy Life 02 sdfsf<span className="jp-artist">by Derwood Spinks</span></Link></div>
                            </li>

                            
                        </ul>
                    </div>
                </div>
            </div>
        </section>    


        
		<section className="related-album-single">
			<div className="container">
				<div className="section-title">
					<h2>RELATED <span>ALBUM</span></h2>
				</div>
                <Carousel responsive={responsive}>
                    <li className=" clearfix swiper-slide ">
                        <div className="single-related-album">
                           
                        <img src={require('../../media/album/ra1.jpg')} alt=""/>
                   
                            <div className="single-related-prod-bottom">
                                <div className="left">
                                    <Link>Funny Litle World</Link>
                                    <p>6 Tracks</p>
                                </div>
                                <Link  className="play-bottom"> <FontAwesomeIcon icon={faPlay} /></Link>
                            </div>
                        </div>
                    </li>
                    <li className=" clearfix swiper-slide ">
                        <div className="single-related-album">
                           
                        <img src={require('../../media/album/ra1.jpg')} alt=""/>
                    
                            <div className="single-related-prod-bottom">
                                <div className="left">
                                    <Link>Funny Litle World</Link>
                                    <p>6 Tracks</p>
                                </div>
                                <Link  className="play-bottom"> <FontAwesomeIcon icon={faPlay} /></Link>
                            </div>
                        </div>
                    </li>
                    <li className=" clearfix swiper-slide ">
                        <div className="single-related-album">
                            
                        <img src={require('../../media/album/ra2.jpg')} alt=""/>
                    
                            <div className="single-related-prod-bottom">
                                <div className="left">
                                    <Link>Funny Litle World</Link>
                                    <p>6 Tracks</p>
                                </div>
                                <Link  className="play-bottom"> <FontAwesomeIcon icon={faPlay} /></Link>
                            </div>
                        </div>
                    </li>
                    <li className=" clearfix swiper-slide ">
                        <div className="single-related-album">
                            
                        <img src={require('../../media/album/ra3.jpg')} alt=""/>
                    
                            <div className="single-related-prod-bottom">
                                <div className="left">
                                    <Link>Funny Litle World</Link>
                                    <p>6 Tracks</p>
                                </div>
                                <Link className="play-bottom"> <FontAwesomeIcon icon={faPlay} /></Link>
                            </div>
                        </div>
                    </li>
                    <li className=" clearfix swiper-slide ">
                        <div className="single-related-album">
                           
                        <img src={require('../../media/album/ra4.jpg')} alt=""/>
                   
                            <div className="single-related-prod-bottom">
                                <div className="left">
                                    <Link>Funny Litle World</Link>
                                    <p>6 Tracks</p>
                                </div>
                                <Link  className="play-bottom"> <FontAwesomeIcon icon={faPlay} /></Link>
                            </div>
                        </div>
                    </li>
                    <li className=" clearfix swiper-slide ">
                        <div className="single-related-album">
                          
                        <img src={require('../../media/album/ra4.jpg')} alt=""/>
                   
                            <div className="single-related-prod-bottom">
                                <div className="left">
                                    <Link>Funny Litle World</Link>
                                    <p>6 Tracks</p>
                                </div>
                                <Link  className="play-bottom"> <FontAwesomeIcon icon={faPlay} /></Link>
                            </div>
                        </div>
                    </li>
                </Carousel>
               
            </div>
        </section>                
         



      
       
				

	
		</div>
           
           
        );
    }
}

export default Radio;




