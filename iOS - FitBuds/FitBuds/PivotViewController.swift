//
//  PivotViewController.swift
//  FitBuds
//
//  Created by David Frankel on 3/2/19.
//  Copyright © 2019 com.FitBuds. All rights reserved.
//

import Foundation
import UIKit
import AVFoundation
import CoreMotion
import CoreML

class PivotViewController : UIViewController {
    
    @IBOutlet weak var viewName: UILabel!
    var testTime : Int? = 3 * 60
    let motion = CMMotionManager()
    var timer : Timer?;
    var data = [Double]()

    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view.
        let utterance = AVSpeechUtterance(string: viewName.text!)
        let synth = AVSpeechSynthesizer()
        synth.speak(utterance)
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    @IBAction func beginPressed(_ sender: Any) {
        let delayInSeconds = ViewController.delayInSeconds
        DispatchQueue.main.asyncAfter(deadline: DispatchTime.now() + delayInSeconds) {
            
            if self.motion.isAccelerometerAvailable {
                self.motion.accelerometerUpdateInterval = 1.0/6.0
                self.motion.startAccelerometerUpdates()
                
                self.timer = Timer(fire: Date(), interval: (1.0/60.0), repeats: true, block: { (timer) in
                    if let data = self.motion.accelerometerData {
                        
                        let x = data.acceleration.x
                        let y = data.acceleration.y
                        let z = data.acceleration.z
                        
                        // WRITE
                        self.data.append(x)
                        self.data.append(y)
                        self.data.append(z)
                        
                    }
                    if self.data.count == 543 {
                        timer.invalidate()
                        
                        let model = pivot_model_v1()
                        
                        guard let mlMultiArray = try? MLMultiArray(shape:[543], dataType:MLMultiArrayDataType.double) else {
                            fatalError("Unexpected runtime error. MLMultiArray")
                        }
                        for (index, element) in self.data.enumerated() {
                            mlMultiArray[index] = NSNumber(floatLiteral: element)
                        }
                        
                        guard let output = try? model.prediction(input: mlMultiArray) else {
                            fatalError("Unexpected runtime error.")
                        }
                        print(output.classLabel)
                        ViewController.results.updateValue(output.classLabel, forKey: "pivot")
//                        Alamofire.request("http://10.106.93.213:8888/push.php?email=" + ViewController.email, method: .post, parameters: ViewController.results, encoding: JSONEncoding.default)
                                            self.performSegue(withIdentifier: "toNarrowTest", sender: self)
                    }
                    self.testTime = self.testTime! - 1
                    
                })
                
                RunLoop.current.add(self.timer!, forMode: .default)
            }
            
        }
    }
    
}
