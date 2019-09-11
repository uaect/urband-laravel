
import React, { Component } from 'react'
import { Link } from 'react-router-dom'
import './album-list.component.css'
class albumListHome extends Component{


    render(){
        return (
        <section className="three-d-album">
            <div className="section-title style-four">
			  <h2>TRENDING ALBUMS</h2>
              <p>There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration in some injected humour.</p>
		</div>

            <div className="three-d-album-width">
                  <div className="row">
                    <div className="threed-container-wrapper">
                        <div className="threed-container-inner">
                            <div className="single-3d empty-space">
                            </div>
                            <div className="single-3d">
                            <Link to="/"><img src={ require('../../media/albumart/1.png') } alt=""/></Link>
                            </div>
                            <div className="single-3d empty-space">
                            </div>
                            <div className="single-3d">
                            <Link to="/"><img src={ require('../../media/albumart/2.png') } alt=""/></Link>
                            </div>
                            <div className="single-3d empty-space">
                            </div>
                            <div className="single-3d">
                                 <Link to="/"><img src={ require('../../media/albumart/3.png') } alt=""/></Link>
                            </div>
                           
                            <div className="single-3d">
                                 <Link to="/"><img src={ require('../../media/albumart/4.png') } alt=""/></Link>
                            </div>
                           
                            <div className="single-3d">
                                 <Link to="/"><img src={ require('../../media/albumart/5.png') } alt=""/></Link>
                            </div>
                            
                            <div className="single-3d">
                                 <Link to="/"><img src={ require('../../media/albumart/7.png') } alt=""/></Link>
                            </div>
                            <div className="single-3d">
                                 <Link to="/"><img src={ require('../../media/albumart/8.png') } alt=""/></Link>
                            </div>
                            <div className="single-3d">
                                 <Link to="/"><img src={ require('../../media/albumart/13.png') } alt=""/></Link>
                            </div>
                        </div>
                    </div>

                 </div>
            </div>    
        </section>                         
        
        );
    }
}
export default albumListHome;
