import React , {Component} from 'react';
import { Link } from 'react-router-dom'

class Artist extends React.Component{


    render(){


        return (
           
            <div>
                 <section className="page-header artist-banner">
                    <div className="tim-container">
                        <div className="page-header-title text-center">
                            <h2>Artists</h2>
                        </div>

                        <div className="breadcrumbs">
                        <Link to="/">Home</Link>
                            <span>/</span>
                            <span>Artists</span>
                        </div>

                    </div>
		
                </section>

                <section id="about-two" className="section-padding">
			<div className="tim-container">
				<div className="row no-gutters">
					<div className="col-lg-6">
						<div className="artist-about pr__30">
							<h3 className="artist-name"><Link to="">James Robinson</Link></h3>
							<h6>Genre : Guitarist/Singer</h6>
							<span>Album: Rockstar, first rain, Love Song (More)</span>
                            <Link to="" className="tim-btn">View Portfolio</Link>

							<div className="content">
								<p>
									There are many variations of passages of Lorem Ipsum available but the majority suffered aboaNalteration in some form by injected humour or randomised words which don't look even slightly nothi belieable. If you are going to use a passage of Lorem Ipsum,
									you need believable.
								</p>

								<p>
									Available but the majority suffered about the are Nalteration in some form by injected humoranomised words which don't look even slightly nothi believable.
								</p>
								<p>
									The majority suffered aboaNalteration in some form by injected humour or randomised words which don't look even slightly nothi belieable. If you are going to use a passage of Lorem Ipsum, you need believable.
								</p>
							</div>
					

							<h4 className="alb-title">Album & Single</h4>

							<div className="alb-single">
								<Link to="" className="single-items"><img src={require('../../media/about/6.jpg')} alt="album"/></Link>
                                <Link to="" className="single-items"><img src={require('../../media/about/7.jpg')} alt="album"/></Link>
                                <Link to="" className="single-items"><img src={require('../../media/about/8.jpg')} alt="album"/></Link>
                                <Link to="" className="single-items"><img src={require('../../media/about/9.jpg')} alt="album"/></Link>
                                <Link to="" className="single-items"><img src={require('../../media/about/10.jpg')} alt="album"/></Link>

								
							</div>
					
						</div>
				
					</div>
			

					<div class="col-lg-6">
						<div class="album-feature">
							<img src={require('../../media/about/11.jpg')} alt="Album"/>
							<div class="artist-music-inner clearfix">
								<div class="aritist-music">
									<div class="icon">
										<i class="tim-music-album"></i>
									</div>

									<div class="content">
										<p>13</p>
										<span>Album</span>
									</div>
								</div>

								<div class="aritist-music clearfix">
									<div class="icon">
										<i class="tim-music-album-1"></i>
									</div>

									<div class="content">
										<p>24</p>
										<span>Single</span>
									</div>
								</div>

								<div class="aritist-music clearfix">
									<div class="icon">
										<i class="tim-sound-frecuency"></i>
									</div>

									<div class="content">
										<p>17</p>
										<span>Concerts</span>
									</div>
								</div>

								<div class="aritist-music clearfix">
									<div class="icon">
										<i class="tim-headphones"></i>
									</div>

									<div class="content">
										<p>16</p>
										<span>Tracks</span>
									</div>
								</div>
							</div>
						</div>
		
					</div>
			
				</div>
            
            	<div className="row no-gutters">
					<div className="col-lg-6">
						<div className="album-feature">
                        <img src={require('../../media/about/12.jpg')} alt="Album"/>
							<div className="artist-music-inner clearfix">
								<div className="aritist-music">
									<div className="icon">
										<i className="tim-music-album"></i>
									</div>

									<div className="content">
										<p>13</p>
										<span>Album</span>
									</div>
								</div>

								<div className="aritist-music clearfix">
									<div className="icon">
										<i className="tim-music-album-1"></i>
									</div>

									<div className="content">
										<p>24</p>
										<span>Single</span>
									</div>
								</div>

								<div className="aritist-music clearfix">
									<div className="icon">
										<i className="tim-sound-frecuency"></i>
									</div>

									<div className="content">
										<p>17</p>
										<span>Concerts</span>
									</div>
								</div>

								<div className="aritist-music clearfix">
									<div className="icon">
										<i className="tim-headphones"></i>
									</div>

									<div className="content">
										<p>16</p>
										<span>Tracks</span>
									</div>
								</div>
							</div>
						</div>
				
					</div>
			
					<div class="col-lg-6">
						<div class="artist-about pl__30 pt_70">
							<h3 class="artist-name"><a href="artist-single.html">Sezar Doue</a></h3>
							<h6>Genre : Guitarist/Singer</h6>
							<span>Album: Rockstar, first rain, Love Song (More)</span>
                            <Link to="" class="tim-btn">View Portfolio</Link>

							<div class="content">
								<p>
									There are many variations of passages of Lorem Ipsum available but the majority suffered aboaNalteration in some form by injected humour or randomised words which don't look even slightly nothi belieable. If you are going to use a passage of Lorem Ipsum,
									you need believable.
								</p>

								<p>
									Available but the majority suffered about the are Nalteration in some form by injected humoranomised words which don't look even slightly nothi believable.
								</p>
								<p>
									The majority suffered aboaNalteration in some form by injected humour or randomised words which don't look even slightly nothi belieable. If you are going to use a passage of Lorem Ipsum, you need believable.
								</p>
							</div>
						

							<h4 class="alb-title">Album & Single</h4>

							<div class="alb-single">
                                <Link to="" className="single-items"><img src={require('../../media/about/6.jpg')} alt="album"/></Link>
                                <Link to="" className="single-items"><img src={require('../../media/about/7.jpg')} alt="album"/></Link>
                                <Link to="" className="single-items"><img src={require('../../media/about/8.jpg')} alt="album"/></Link>
                                <Link to="" className="single-items"><img src={require('../../media/about/9.jpg')} alt="album"/></Link>
                                <Link to="" className="single-items"><img src={require('../../media/about/10.jpg')} alt="album"/></Link>
								
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

export default Artist;



