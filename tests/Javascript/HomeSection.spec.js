import {mount} from 'vue-test-utils';
import HomeSection from '../../resources/assets/js/components/HomeSection.vue';
import expect from 'expect';
import Helpers from 'mwangaben-vthelpers';
import moxios from 'moxios';


describe('HomeSection', () => {
       let wrapper, b;
     beforeEach(() => {
     	moxios.install();
        wrapper = mount(HomeSection);
        

        wrapper.setData(() => {
        	datas : [
        	{
        		introlead: "Intro Lead",
				introhead: "Intro Head",
				infoButton: "Bit button",
				id : 1
			}
        	]
        });

        b = new Helpers(wrapper, expect);
     })

     afterEach(() => {
     	moxios.uninstall();   
     })

	it('it show normal content', (done) => {


		moxios.wait(() => {
		b.see('Intro Lead', '.intro-lead-in')
		b.see('Intro Head', '.intro-heading')

			done()
		})
		// b.see('Bit Button', '.js-scroll-trigger')
	});

	it(' it can be edited', () => {
			b.click('#edit')
			b.domHas('input[name=introlead]')
			b.domHas('input[name=introhead]')
			b.domHas('input[name=infoButton]')

	});

	it('it can cancel edeting', () => {
		b.click('#edit')

		b.domHas('input[name=introlead]')

		b.click('#cancel')

		b.see('Intro Lead', '.intro-lead-in')


	});

	it('it can update the data', (done) => {
		b.click('#edit')

		b.domHas('input[name=introlead]')

		moxios.stubRequest(/homesection\/\d+/, {
			 response : {
			 	status : 200,
			 	data: {
			 		message :'Okay'
			 	}
			 }
		});

	    b.type('Intro Leading', 'input[name=introlead]')
		b.type('Intro Heading', 'input[name=introhead]')
		b.type('Tell More', 'input[name=infoButton]')

		b.click('#update')

		moxios.wait(() => {
			expect(wrapper.emitted().updated).toBe(true);
			done();
		})

	});
	
});