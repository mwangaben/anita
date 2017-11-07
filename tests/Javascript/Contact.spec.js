import {mount} from 'vue-test-utils';
import ContactUsForm from '../../resources/assets/js/components/ContactUsForm.vue';
import expect from 'expect';


describe('ContactUsForm', () => {
       let wrapper;
     beforeEach(() => {
        wrapper = mount(ContactUsForm);
     });

	it('it should have name field', () => {
		expect(wrapper.contains('input#name')).toBe(true);
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

	it('it should receive the input', () => {
		// type('input#name', 'Benedict');
		// type('input#email', 'mwangaben@gmail.com');
		// type('input#phone', '0717031351');
		// type('textarea#message', 'Hello world');

		// expect(wrapper.vm.form.name).toContain('Benedict');

		// // console.log(wrapper.vm.form.errors);
		// let submit = wrapper.find('#sendMessageButton');
  //       expect(wrapper.contains('#sendMessageButton')).toBe(true);
		//  submit.trigger('click');
		 wrapper.vm.onSubmit();
		 console.log(wrapper.emitted());
		// expect(wrapper.emitted().submitted).toBeTruthy();
		// expect(wrapper.emitted().failed).toBeTruthy();
		// expect(wrapper.find('div#success').html()).toContain('success');


	});

	let type = (field, data) => {
		let nameInput = wrapper.find(field);
		nameInput.element.value = data;
		nameInput.trigger('input');
	}
	
});


