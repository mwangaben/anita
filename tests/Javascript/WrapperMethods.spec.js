import {mount} from 'vue-test-utils';
import WrapperMethods from '../../resources/assets/js/components/WrapperMethods.vue';
import expect from 'expect';
import jest from 'jest-mock';


describe('WrapperMethods', () => {
       let wrapper;
     beforeEach(() => {
        wrapper = mount(WrapperMethods);
        wrapper.setProps({ message: {
			    type: String,
			    required: true,
			    validator: message => message.length > 1
               }
          });
     })
	it('it checks if the WrapperMethods is vue instance', () => {
		expect(wrapper.isVueInstance()).toBe(true);
	});

	it('the is to checks the root element', () => {
		expect(wrapper.is('.master')).toBe(true);
	});

	it('the find  and exists methods', () => {
		let ul = wrapper.find('ul');
		expect(ul.exists()).toBeTruthy();
	});

	it('the contains method', () => {
		expect(wrapper.contains('ul')).toBeTruthy();
	});

	it('the isEmpty method', () => {
		let span = wrapper.find('span');
		expect(span.isEmpty()).toBe(true);
	});

	it('the hasAttribute method', () => {
		let span = wrapper.find('span');
		expect(span.hasAttribute('class', 'rain-bow')).toBe(true);
	});

	it('the hasClass method', () => {
		let span = wrapper.find('span');
		expect(span.hasClass('rain-bow')).toBeTruthy();
	});

	it('the hasStyle and getStyle method', () => {
		let span = wrapper.find('span');
		expect(span.hasStyle('padding-top', '2em')).toBe(true);
	});

	it('the hasProps method', () => {
		wrapper.setProps({ age: 24 });
		expect(wrapper.hasProp('age', 24)).toBeTruthy();
	});

	it('the default parameter', () => {
		wrapper.setProps({ message: 'MwangaBen'});
		expect(wrapper.hasProp('author', 'MwangaB')).toBe(true);
		expect(wrapper.hasProp('message', 'MwangaBen')).toBe(true);
	});

	// it('it validate the props', () => {
	// 	let spy = jest.spyOn(console, 'error')
	// 	let cmp = wrapper.setProps({ message : 1 });
	// 	expect(spy).toBeCalledWith(expect.stringContaining('[Vue warn]: Missing required prop'))

	// 	spy.mockReset();
	// });

	it('the message String', () => {
		const message = wrapper.vm.$options.props.message;
		expect(message.type).toBe(String)

	});

	it('the message is required', () => {
		const message = wrapper.vm.$options.props.message;
		expect(message.required).toBeTruthy();
	});

	it('the message has at least 2', () => {
		const message = wrapper.vm.$options.props.message;
		expect(message.validator && message.validator('a')).toBeFalsy();
		expect(message.validator && message.validator('aa')).toBeTruthy();	
	});










});