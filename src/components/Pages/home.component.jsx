import React , {Component} from 'react';
import SliderHero from '../slider/slider.component'
import H5AudioPlayer from '../AudioPlayer/audioplayer.component'
import MultiCarousel from '../MultiCarousel/artist-lineup.component'
import MultiCarouselHero from '../MultiCarousel/multi-carousel'
import PlayAnimation from '../LatestRelease/play-animation.component'
import AlbumListHome from '../LatestAlbums/album-list.component'
import PreviousShowHome from '../PreviousShows/previous-show.component'
import UpcomingShowHome from '../UpcomingShows/upcoming-shows.component'
import SpotLight from '../SpotLight/spot-light.component'

class HomePage extends React.Component{


    render(){

        return (

          <div>
            <SliderHero/>
            <H5AudioPlayer
            src="https://ia802508.us.archive.org/5/items/testmp3testfile/mpthreetest.mp3"
            onPlay={e => console.log("onPlay")}
            // other props here
            />
            <MultiCarousel/>
            <MultiCarouselHero/>
            <PlayAnimation/>
            <AlbumListHome/>
            <PreviousShowHome/>
            <UpcomingShowHome/>
            <SpotLight/>
            
           
         </div>
           
        );
    }
}

export default HomePage;




