//
//  ViewController.swift
//  FitBuds
//
//  Created by David Frankel on 3/1/19.
//  Copyright © 2019 David Frankel. All rights reserved.
//

import UIKit
import CoreMotion

class ViewController: UIViewController {
    
    var testTime : Int? = 0;
    let motion = CMMotionManager();
    var timer : Timer?;
    
    @IBOutlet weak var timeDataField: UITextField!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
    }

    @IBAction func testTimeChanged(_ sender: Any) {
        
        self.testTime = Int(self.timeDataField.text!)!  * 60
//        print(testTime!)
    }
    
    @IBAction func buttonPressed(_ sender: Any) {
        if self.motion.isAccelerometerAvailable {
            self.motion.accelerometerUpdateInterval = 1.0/6.0
            self.motion.startAccelerometerUpdates()
            
            self.timer = Timer(fire: Date(), interval: (1.0/60.0), repeats: true, block: { (timer) in
                if let data = self.motion.accelerometerData {
                    let x = data.acceleration.x
                    let y = data.acceleration.y
                    let z = data.acceleration.z
                    
                    // WRITE
                    
                    print(x, terminator:",")
                    print(y, terminator:",")
                    print(z, terminator:",")
                    
                }
                if self.testTime! < 1 {
                    timer.invalidate()
                }
                self.testTime = self.testTime! - 1
                
            })
            
            RunLoop.current.add(self.timer!, forMode: .default)
            
        }
        
        
    }
}

