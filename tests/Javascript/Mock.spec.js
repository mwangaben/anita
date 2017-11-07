// jest.mock('axios', () => {
// 	get: jest.fn()
// });
import {
    mount, shallow
} from 'vue-test-utils';
import Mock from '../../resources/assets/js/components/Mock.vue';
import expect from 'expect';
import Jquery from 'jquery';
import jest from 'jest-mock';
describe('Mock', () => {
    let wrapper;
    beforeEach(() => {
        wrapper = mount(Mock);
    })
    it('it should return value close to the answer', () => {
        expect(1.2 + 1.3).toBeCloseTo(2.5);
        expect('benedict').toMatch(/[a-z]/);
        // expect(1 / 3).toBeCloseTo(0.3, 7);
    });
    it('it test the async', done => {
        function callabo(a) {
            expect(a).toBe('A');
            done();
        }
        byTime(callabo, 'A');
    });
    it('it test the promise', () => {
        expect.assertions(1);
        let b = 'B';
        return expect(byTime((a, b) => {})).resolves.toBe('benny');
    });
    it('it testing the jest mocking', () => {
        const mockCallback = jest.fn();
        forEach([0, 1], mockCallback);
        expect(mockCallback.mock.calls.length).toBe(2);
        //check the first call 
        expect(mockCallback.mock.calls[0][0]).toBe(0);
    });
    it('it checks the first arguments passed to the callback', () => {
        const mockCallback = jest.fn();
        forEach([2, 3], mockCallback);
        expect(mockCallback.mock.calls[0][0]).toBe(2);
    });
    it('it checks the second arguments passed to the callback ', () => {
        const mockCallback = jest.fn();
        forEach([2, 3], mockCallback);
        expect(mockCallback.mock.calls[1][0]).toBe(3);
    });
    it('it checks the third arguments passed to be callback', () => {
        const mockCallback = jest.fn();
        forEach([2, 3, 4], mockCallback);
        expect(mockCallback.mock.calls[2][0]).toBe(4);
    });
    it('class mocking ', () => {
        // const myMock = jest.fn();
        // const a = new myMock();
        // const b = {
        //     a: 'Hello'
        // };
        // const bound = myMock.bind(b);
        // bound();
        // let names = new Person();
        // // names.name();
        // console.log(myMock.mock.instances);
        // expect(names.name().mock.instances.length).toBe(1);
    });
    it('it checks the returned values', () => {
        const myMock = jest.fn();
        // console.log(myMock());
        // > undefined
        myMock.mockReturnValueOnce(10).mockReturnValueOnce('x').mockReturnValue(true);
        expect(myMock()).toBe(10);
        expect(myMock()).toBe('x');
        expect(myMock()).toBe(true);
        // console.log(myMock(), myMock(), myMock(), myMock());
    });

    it('is the vue instance', () => {
    	expect(wrapper.isVueInstance()).toBe(true);
    });
    it('checks the presence of ul', () => {
		   expect(wrapper.exists('ul')).toBe(true); 
		   expect(wrapper.contains('ul')).toBe(true);
    });

    it('it inspects the root level', () => {
    		expect(wrapper.is('div')).toBe(true);
    });

    it('it checks the emptiness ', () => {
    		expect(wrapper.find('li').isEmpty()).toBe(true);
    });

    it('it checks the attribute of the html tag', () => {
    		expect(wrapper.find('ul').hasAttribute('class', 'list')).toBe(true);
    });

    it('it checks ', () => {
    		
    });
    

    function byTime(callback, arg) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                callback(arg);
                resolve('benny');
                // return arg !== 'A' ? resolve('benny') : reject('mwanga');
            }, 10);
            // if(arg == 'A')  reject('Mwanga');
        });
    }

    function add(a) {
        return 2 * a;
    }

    function forEach(items, callback) {
        for (let i = 0; i < items.length; i++) {
            callback(items[i]);
        }
    }
    class Person {
        name() {
            return 'Mwanga';
        }
        getName() {
            return this.name();
        }
    }
});