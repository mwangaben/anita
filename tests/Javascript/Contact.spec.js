import {mount} from 'vue-test-utils';
import ContactUsForm from '../../resources/assets/js/components/ContactUsForm.vue';
import expect from 'expect';
import Helpers from 'mwangaben-vthelpers';
import moxios from 'moxios';


describe('ContactUsForm', () => {
       let wrapper, b;
     beforeEach(() => {
     	moxios.install();

        wrapper = mount(ContactUsForm);

         b = new Helpers(wrapper, expect);
     });


     afterEach(() => {
     	moxios.uninstall();
     })

	it('it should have name field', () => {
		b.domHas('input#name')
	});

	it('it should have email field', () => {
		expect(wrapper.contains('input#email')).toBe(true);
	});

	it('it should have phone field', () => {
		expect(wrapper.contains('input#phone')).toBe(true);
	});

	it('it should have message field', () => {
		expect(wrapper.contains('textarea#message')).toBe(true);
	});

	it('it should receive the input', (done) => {
		b.type('Benedict', 'input[name=name]');
		b.type('mwangaben@gmail.com', 'input#email');
		b.type('0717031351','input#phone',);
		b.type('Hello world','textarea#message');

		b.inputValueIs('Benedict','input#name');

		moxios.stubRequest('/messages', {
			   response : {
			   		response : 200,
			   		data: {
			   			name : 'Benedict'
			   		}
			   		
			   }
		})

		b.click('#sendMessageButton')
		// wrapper.vm.$emit('okay');
		 moxios.wait(() => {
         // console.log(wrapper.emitted())
		 expect(wrapper.emitted().okay).toBeTruthy();
		 done();
		})
        


	});
	
     it('it should show a form to the guest', () => {
     	wrapper.setComputed({ signedIn : false})

     	 b.domHas('.guest')
     	 b.domHas('input[name=name]')
     });

     it('it present a form for a signed user', () => {
     	 // wrapper.setComputed({ signedIn : true})
     	 wrapper.setMethods({ signedIned : true});

     	 b.domHas('.signed')
     	 b.domHasNot('input[name=name]')

     });



});


