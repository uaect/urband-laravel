import React  from 'react';
import sliderHeroimg1 from '../../media/background/mouse-move.png';


class sliderHero extends React.Component{


    render(){
        return (    
          <section className="banner-five">
            <div className="tim-container">
              <div id="para" className="paralax">
                <div id="paralax-1" className="scene">
                  <div data-depth="-0.50"> <img src={sliderHeroimg1}/></div>
                </div>
              </div>
              <div className="baneer-five-content">
                <div className="content sp-container">
                  <div className="sp-content">
                    <div className="sp-globe"></div>
                    <h2 className="frame-1">MILANDO</h2>
                    <h2 className="frame-2">JOHN LENNON</h2>
                    <h2 className="frame-3">PAUL McKART</h2>
                    <h2 className="frame-4">GEORGE HARRIS</h2>

                  </div>
                  <h3>DYNNEX HALL - March 17, 2018</h3>
                  <a className="tim-slide-btn" href="index.html#">TICKETS</a>
                </div>
              </div>
            
            </div>


        <div className="smoke-wrqpper">
          <canvas id="canvas"></canvas>
        </div>

</section>
                      
        
        );
    }
}

export default sliderHero;
